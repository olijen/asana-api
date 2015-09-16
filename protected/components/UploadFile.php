<?php
/**
 * @author Olijen
 * @version 1.2
 */

/*
---EXAMPLE--- (required YiiWheels)
--Behavior in model:--
    public function behaviors(){
        return array(
            'uploadFile' => array(
                'class'  => 'UploadFile',
                'path'   => '/img/project/',
                'field'  => 'image',
                'allow'  => array("jpg", "jpeg", "png", "gif"),
            ),
        );
    }
--Widget for file uploader--
    <?php if ($model->isNewRecord) : ?>
        <p style="color: #FF9900;">Загрузка изображений доступна только после создания</p>
    <?php else : 
            if (!empty($model->img)) : ?>
                <img id="upload" src="<?=$model->img?>" width="50%"/>
    <?php   endif;
        //FineUploader
        $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
            'name'           => 'qqfile',
            'uploadAction'   => $this->createUrl('/admin/advert/upload/id/'.$model->id),
            'events'=>array(
                'complete'=>"function(e, x, c, response) {
                    console.log(response.file_full);
                    $('#upload').attr('src', response.file_full);
                }",
            ),
            'pluginOptions'  => array(
                'validation' => array(
                    'allowedExtensions' => array('jpeg', 'jpg', 'gif', 'png')
                )
            ),
            'htmlOptions' => array(
                'class'=>'btn btn-success',
                'style'=>'border-radius: 5px;'
            ),
        ));
    endif; ?>*/

class UploadFile extends CBehavior
{
    public $path      = '/files/';
    public $allow     = array("jpg", "jpeg", "png", "doc", "txt", "pdf", "zip", "docx", "xls", "xlsx", "txt");
    public $size      = 1000000;
    public $field     = 'file';

    public $setMime   = false;
    public $mimeField = 'mime';

    private $_oldName = NULL;

    public function upload()
    {
        $fileRoot = Yii::getPathOfAlias('webroot').$this->path;

        if (!file_exists($fileRoot))
            mkdir($fileRoot, 0775);

        $uploader = new qqFileUploader($this->allow, $this->size);
        $result   = $uploader->handleUpload($fileRoot);

        if (isset($result['error']))
            die(CJSON::encode(array('error' => $result['error'])));

        $fileSize = filesize($fileRoot . $result['filename']);
        $mime = trim (@exec('file -bi '.escapeshellarg($fileRoot.$result['filename'])));

        if (!empty($this->owner{$this->field}) && file_exists(substr($this->owner{$this->field}, 1))) {
            unlink(substr($this->owner{$this->field}, 1));
        }

        if ($this->toDb($result['filename'], $mime)) {
            $result['file_full'] = $this->owner->{$this->field};
            return htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        } else {
            return false;
        }
    }

    private function toDb($result, $mime)
    {
        $this->owner->{$this->field} = $this->path . $result;
        if ($this->setMime) {
            $this->owner->{$this->mimeField} = $mime;
        }

        if ($this->owner->save()) {
            return true;
        } else {
            return false;
        }
    }
}

//----------------------- QQ FILE UPLOADER ---------------------------------------------------

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {

        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()){
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }
    function getName() {
        return $_GET['qqfile'];
    }
    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])){
            return (int)$_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
            return false;
        }
        return true;
    }
    function getName() {
        return $_FILES['qqfile']['name'];
    }
    function getSize() {
        return $_FILES['qqfile']['size'];
    }
}

class qqFileUploader {
    private $allowedExtensions = array();
    private $sizeLimit = 10485760;
    private $file;

    function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760){
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

        $this->allowedExtensions = $allowedExtensions;
        $this->sizeLimit = $sizeLimit;

        $this->checkServerSettings();

        if (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        }
        elseif (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } else  {
            $this->file = false;
        }
    }

    private function checkServerSettings(){
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';

            die(CJSON::encode(array('error' => 'increase post_max_size and upload_max_filesize to '.$size)));
        }
    }

    private function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($uploadDirectory, $replaceOldFile = FALSE){
        
        if (!is_writable($uploadDirectory)){
            return array('error' => "Server error. Upload directory isn't writable.");
        }

        if (!$this->file){
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }

        $pathinfo = pathinfo($this->file->getName());
        $filename = $pathinfo['filename'];
       
        $ext = $pathinfo['extension'];

        $old_name = $filename.'.'.$ext;
            
        if($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }

        if(!$replaceOldFile){
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand(10, 99);
            }
        }

        $filename = time()."cd".md5(time().$filename);

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)){
            return array('success'=>true,'filename'=>$filename.'.'.$ext, 'old_name'=>$old_name );
        } else {
            return array('error'=> 'Could not save uploaded file.' . 'The upload was cancelled, or server error encountered');
        }

    }
}
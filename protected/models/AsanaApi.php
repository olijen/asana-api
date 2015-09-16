<?php 
date_default_timezone_set('Etc/GMT-3');
class AsanaApi extends CFormModel
{
    protected $_asana      = null;
    protected $_workspaces = null;
    protected $_projects   = null;
    protected $_tasks      = null;
    
    const DATE_FORM        = "d.m.y h:i";
    const DATE_FORM_DIFF   = "%R %h:%i";
    const DATE_FORM_HOURS  = "h:i:s";
    
    public function getWorkspaces()
    {
        if (null === $this->_projects) {
            $workspaces = $this->asana->getWorkspaces();
            $this->checkError($workspaces);
            $this->_workspaces = json_decode($workspaces);
        }
        return $this->_workspaces;
    }
    
    
    public function getProjects()
    {
        if (null === $this->_projects) {
            $this->checkError();
            $this->_projects = json_decode($this->workspaces);
        }
        return $this->_projects;
    }
    
    public function getWorkspace($id)
    {
        
    }
    
    public function getProject($id)
    {
        
    }
    
    public function getTask($id)
    {
        $api = $this->asana;
        $taskJson = $api->asana->getTask($id);
        $api->checkError($taskJson);
        return $task = json_decode($taskJson)->data;
    }
    
    public function start($id)
    {
        $this->asana->commentOnTask($id, ' >>> Начал рабоу над таском');
    }
    
    public function stop($id)
    {
        $this->asana->commentOnTask($id, ' >>> Остановил работу над таском');
    }
    
    public function complate($id)
    {
        $resp = $this->asana->updateTask($id, array(
            'completed'=>true, 
        ));
    }
    
    public function getAsana()
    {
        if ($this->_asana === null)
            $this->_asana = new Asana(array('apiKey' => thisProfile()->api_key));
        return $this->_asana;
    }
    
    //--- SERVICE
    
    public function checkError($now)
    {
        if ($this->asana->responseCode != '200' || is_null($now)) {
            throw new CException('Error while trying to connect to Asana, response code: ' . $this->asana->responseCode);
        }
        return true;
    }
    
    
    //--- CONVERTERS
    
    public static function convertDate($date)
    {
        $time = new DateTime($date);
        return $time->format(AsanaApi::DATE_FORM);
    }
    
    public function convertTimestamp($ts)
    {//return self::tsToTime($ts);
        $min = '';
        if ($ts < 0) $min = '-';
        $time = new DateTime();
        $time->setTimestamp($ts);
        return $min.$time->format(AsanaApi::DATE_FORM);
    }
    
    public function convertTsToHours($ts)
    {return self::tsToTime($ts);
        $min = '';
        if ($ts < 0) $min = '-';
        $time = new DateTime();
        $time->setTimestamp($ts);
        return $min.$time->format(AsanaApi::DATE_FORM_HOURS);
    }
    
    public function convertToTs($date)
    {
        $time = new DateTime($date);
        return $time->getTimestamp();
    }
    
    public function tsToTime($ts)
    {
        $minus = '';
        if ($ts <= 0) $minus = '-';
        return $minus.(int)(abs($ts) / 60 / 60).':'.(int)(abs($ts) / 60);
    }
    
    public function model()
    {
        return new self;
    }
}
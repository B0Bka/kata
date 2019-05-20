<?
class englishTime
{
    private $time, $hour, $minutes, $sufix;
    public function __construct($time)
    {
        $this->time = $time;
    }

    public function getLiteralTime()
    {
        try
        {
            $this->checkTime();
            $this->explodeTime();
            echo $this->convertTime();
        }
        catch (Exception $e)
        {
            echo("Error: {$e->getMessage()}\n");
        }
    }

    private function checkTime()
    {
        if (empty($this->time))
            throw new Exception("Time is empty!");
        elseif(!preg_match('/[012][0-9]:[0-5][0-9]/', $this->time))
            throw new Exception("Invalid format! Use 00:00");

        return true;
    }

    private function explodeTime()
    {
        list($hour, $minutes) = explode(':', $this->time);
        $this->hour = intval($hour);
        $this->minutes = intval($minutes);
    }

    private function convertTime()
    {
        $result = '';

        if($this->hour >=0 && $this->hour < 12)
        {
            $this->sufix = 'a.m';
            $this->hour = $this->hour == 0 ? 12 : $this->hour;
        }
        elseif($this->hour >= 12 && $this->hour < 24)
        {
            $this->sufix = 'p.m';
            $this->hour = $this->hour == 12 ? 12 : $this->hour - 12;
        }
        else
            throw new Exception('Invalid hour');

        if($this->minutes == 15)
            $strMinute = 'a quarter past';
        elseif($this->minutes == 45)
            $strMinute = 'a quarter to';
        elseif($this->minutes == 30)
            $strMinute = 'half past';
        elseif($this->minutes < 30 && $this->minutes > 0)
            $strMinute = $this->minutes.' minutes past ';
        elseif($this->minutes > 30 && $this->minutes < 60)
            $strMinute = 60 - $this->minutes.' minutes to ';
        elseif($this->minutes == 00)
            $strMinute = $this->hour." ".$this->sufix;

        $result = 'It is '.$strMinute.' '.$this->getHourStr();
        return $result;
    }

    private function getHourStr()
    {
        $result = '';
        if($this->minutes > 30)
            $result = $this->hour == 12 ? 1 : $this->hour + 1;
        else
            $result = $this->hour;

        return $result.' '.$this->sufix;
    }
}

$time = new englishTime('16:59');
$time->getLiteralTime();
?>
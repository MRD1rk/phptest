<?php


namespace Models;


use Core\Model;

class CompareDate extends Model
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $ip_address;
    /**
     * @var string
     */
    protected $first_operand;
    /**
     * @var string
     */
    protected $second_operand;
    /**
     * @var int
     */
    protected $different;
    /**
     * @var int
     */
    protected $execution_time;
    /**
     * @var string
     */
    protected $date_add;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * @param string $ip_address
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
    }

    /**
     * @param string $first_operand
     */
    public function setFirstOperand($first_operand)
    {
        $this->first_operand = $first_operand;
    }

    /**
     * @return string
     */
    public function getFirstOperand()
    {
        return $this->first_operand;
    }

    /**
     * @return string
     */
    public function getSecondOperand()
    {
        return $this->second_operand;
    }

    /**
     * @param string $second_operand
     */
    public function setSecondOperand($second_operand)
    {
        $this->second_operand = $second_operand;
    }

    /**
     * @return int
     */
    public function getExecutionTime()
    {
        return $this->execution_time;
    }

    /**
     * @param float $execution_time
     */
    public function setExecutionTime($execution_time)
    {
        $this->execution_time = $execution_time;
    }

    /**
     * @return string
     */
    public function getDateAdd()
    {
        return $this->date_add;
    }

    /**
     * @param string $date_add
     */
    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
    }

    public static function findFirst($params = null)
    {
        return parent::findFirst($params);
    }

    public static function find($params = null)
    {
        return parent::find($params);
    }

    public static function getSource()
    {
        return 'compare_date';
    }

    public function columnMap()
    {
        return [
            'id' => 'id',
            'ip_address' => 'ip_address',
            'first_operand' => 'first_operand',
            'second_operand' => 'second_operand',
            'different' => 'different',
            'execution_time' => 'execution_time',
            'date_add' => 'date_add'
        ];
    }


    public function processCompare($date)
    {
        $date = preg_replace('/\s/', '', $date);
        $date = explode('-', $date);
        $first_operand = $date[0];
        $second_operand = $date[1];
        $datetime1 = date_create($first_operand);
        $datetime2 = date_create($second_operand);
        if (!$datetime1 || !$datetime2) {
            $this->setMessage('Не корректный формат даты, введите дату в формате <strong>dd.mm.yyyy</strong>');
            return false;
        }
        $start = microtime(true);
        $different = $this->dateDifference($datetime1, $datetime2);
        $end = microtime(true) - $start;
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->setFirstOperand($first_operand);
        $this->setSecondOperand($second_operand);
        $this->setIpAddress($ip);
        $this->setDifferent($different);
        $this->setExecutionTime($end);
        if (!$this->save()) {
            $this->setMessage('Произошла ошибка при сравнении даты');
            return false;
        }
        return true;

    }


    function dateDifference($datetime1, $datetime2, $differenceFormat = '%a')
    {
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);

    }

    /**
     * @return int
     */
    public function getDifferent()
    {
        return $this->different;
    }

    /**
     * @param int $different
     */
    public function setDifferent($different)
    {
        $this->different = $different;
    }
}
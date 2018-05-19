<?php
class Model{

	private $pdo;
	protected $table;
	protected $validates = [];

	public function __construct()
    {
        if ($this->table === null){
            preg_match("/[a-z]+/i", get_called_class(), $matches);
            $this->table = strtolower($matches[0]) .'s';
        }
    }

    public function getPDO()
	{
		if ($this->pdo ===  null) {
			$this->pdo = new PDO('mysql:host=localhost;dbname=tutoriel', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return $this->pdo;
	}

	private function query($statement)
	{
		$req = $this->getPDO()->query($statement);
		if (strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0 ||
			strpos($statement, 'UPDATE') === 0
		) {
			return $req;
		}
		// $req->closeCursor();
        return  $req->fetchAll(PDO::FETCH_CLASS, get_called_class());
	}

	private function prepare($statement, $params)
	{
		$req = $this->getPDO()->prepare($statement);
		$req->execute($params);
		if (strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0 ||
			strpos($statement, 'UPDATE') === 0
		) {
			return $req;
		}
		//$req->closeCursor();
		return  $req->fetchAll(PDO::FETCH_CLASS, get_called_class());
	}

	public function find($sql =null)
	{
		$fields 	= null;
		$resKey 	= [];
		$resValue 	= [];
		
		$req = 'SELECT ';
		//les champs
		if (isset($sql['fields'])) {
			$fields = implode(', ', $sql['fields']);
		}else{
			$fields = '*';
		}

		$req .= $fields .' FROM '.$this->table;
		//les conditions : where
		if (isset($sql['conditions'])) {
			foreach ($sql['conditions'] as $cles => $valeur) {
				$resKey[] = $cles .' ?';
				$resValue[] = htmlspecialchars($valeur);
			}
			$req .= ' WHERE ' .implode(' AND ', $resKey);
		}
	
		//les jointures
		if (isset($sql['join'])) {
			if (isset($sql['join']['mode'])) {
				$req .= ' '.strtoupper($sql['join']['mode']).' ';
			}else{
				$req .=  ' LEFT JOIN ';
			}
			if (isset($sql['join']['table']) && isset($sql['join']['on'])) {
				$req .= $sql['join']['table'] . ' ON '.$sql['join']['on'];
			}
		}
			
		//ordonner par
		if (isset($sql['order'])) {
			$req .= ' ORDER BY '.$sql['order'];
		}

		//les limites
		if (isset($sql['limit'])) {
			$req .= " LIMIT ".$sql['limit'];
		}

		$data = $this->prepare($req, $resValue);
		return $data;
	}

    public function findCurrent($sql)
    {
        return current($this->find($sql));
	}

    /**
     * @param $table
     * @return $this
     */
    public function getTable($table)
    {
        $this->table =  $table;
        return $this;
	}


    /**
     * @return bool
     */
    public function validate()
    {
        if (!empty($this->validates) && !empty($_POST)){
            $this->Form->validateur->check($this->validates);
            if ($this->Form->validateur->getErrors()){
                return false;
            }else{
                return true;
            }
        }
	}

	/**
     * @param $fields
     * @return array|PDOStatement
     */
    public function save($fields)
    {
        $cles = [];
        $valeurs = [];
        foreach ($fields as $key => $value) {
            $cles[] = $key;
            $valeurs[] = ':'.$key;
        }
        $clesAll = implode(', ', $cles);
        $valeursAll = implode(', ', $valeurs);

        return $this->prepare('INSERT INTO '.$this->table.' ('.$clesAll.') VALUES('.$valeursAll.')', $fields);
    }

    /**
     * @param array $conditions
     * @param array $fields
     * @return array|PDOStatement
     */
    public function update(array $conditions , array $fields)
    {
        $sql_parts_keys = [];
        $attributs      = [];
        $where_id       = [];
        $where_value    = [];
        foreach ($fields as $key => $value) { //pour les champs
            $sql_parts_keys[]   = htmlspecialchars("$key = :$key");
            $attributs[]        = htmlspecialchars($value);
        }
        foreach ($conditions as $condition => $cond) { // pour les conditions
            $where_id[]         = "$condition=:$condition";
            $where_value[]      = $condition;
        }
        $sql_parts_keys         = implode(', ', $sql_parts_keys);
        $where_id               = implode(' And ', $where_id);
        $attributs              = array_merge($where_value, $attributs);
        return $this->prepare("UPDATE ".$this->table. " SET ".$sql_parts_keys ." WHERE ".$where_id, $attributs);
    }

}
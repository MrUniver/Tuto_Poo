<?php
/**
 * Class Validateur
 */
class Validateur{

	private $params;
	private $errors= [];

    /**
     * liste des messages associer aux regles
     * @var array
     */
	private $messages = [
		'minlength' => "Le champs %s requis minimun %d caractères",
		'maxlength' => "Le champs %s requis maximun %d caractères",
		'email'		=> "Le champs %s doit être un email valide",
		'unique'	=> "L'utilisateur a déjà été pris, veuillez en choisir un autre",
        'equal'     => "Les deux mot de passe doivent correspondre",
        "complex"   => "Le champs %s exige un mot de passe complexe minimum 1 minuscule, 1 majuscule, 1 chiffre et un caractère spécial"
	];

    /**
     * liste des regles
     * @var array
     */
	private $regles = ['maxlength', 'minlength', 'email', 'unique', 'between', 'complex', 'equal'];

   private $complex = '#^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]+)$#';
    /**
     * @var Model
     */
    private $db;

    /**
     * Validateur constructor.
     * @param $params
     * @param Model $db
     */
	public function __construct($params, Model $db)
	{
		$this->params = $params;
        $this->db = $db;
    }

    /**
     * @param string $field
     * @return bool
     */
	private function has(string $field)
	{
		return array_key_exists($field, $this->params);
	}

    /**
     * @param string $rule
     * @param string $field
     * @param array|null $options
     */
	private function addError(string $rule, string $field, $options = null)
	{
		$this->errors[$field][] = sprintf($this->messages[$rule], $field, $options);
	}

    /**
     * @param string $field
     * @param int $nbrmin
     */
	private function minlength(string $field, int $nbrmin = 5)
	{
		if (mb_strlen($this->params[$field]) <= $nbrmin) {
			$this->addError('minlength', $field, $nbrmin);
		}
	}

    /**
     * @param string $field
     * @param int $nbrmax
     */
	private function maxlength(string $field, int $nbrmax = 20)
	{
		if (mb_strlen($this->params[$field]) >= $nbrmax) {
			$this->addError('maxlength', $field, $nbrmax);
		}
	}

    /**
     * @param string $field
     */
	private function email(string $field)
	{
		if (!filter_var($this->params[$field], FILTER_VALIDATE_EMAIL)) {
			$this->addError('email', $field);
		}
	}

    /**
     * @param string $field
     * @param string $table
     */
	private function unique(string $field, string $table){

		$rs = $this->db->getTable($table)->find(array(
		    'conditions' => array(
		        $field.'=' => $this->params[$field]
            )
        ));
		if (!empty($rs)) {
			$this->addError('unique', $field);
		}
	}

    /**
     * @param string $field
     * @param string $parametre
     * @return bool
     */
	private function between(string $field, string $parametre)
	{
		$nbrs = explode(':', $parametre);
		if ($this->minlength($field, (int) $nbrs[0]) OR $this->maxlength($field, (int)$nbrs[1])) {
			return true;
		}
	}

    /**
     * @param string $field
     * @param string $field_confirm
     */
    private function equal(string $field, string $field_confirm)
    {
        if ($this->params[$field] !== $this->params[$field_confirm]){
            $this->addError('equal', $field);
        }
	}

    /**
     * @param string $field
     * @param string $parametre
     * @return void
     */
    private function complex(string $field, string $parametre)
    {
        if (!preg_match($this->complex, $this->params[$field])){
            $this->addError('complex', $field);
        };
	}

    /**
     * @param array $items
     */
	private function valide(array $items)
	{
		foreach ($items['regles'] as $regle => $parametre) {
			if (in_array($regle, $this->regles)) {
				$this->$regle($items['champs'], $parametre);
			}
		}
	}

    /**
     * @param array $regles
     */
	public function check(array $regles)
	{
		foreach ($regles as $champs => $rules) {
			if ($this->has($champs)) {
				$this->valide([
					'champs' => $champs,
					'regles' => $rules,
				]);
			}
		}
	}

    /**
     * @return array
     */
	public function getErrors()
	{
		return $this->errors;
	}

    /**
     * @param string $name
     * @return bool|mixed
     */
	public function getError(string $name)
	{
		return $this->errors[$name] ?? false;
	}

}
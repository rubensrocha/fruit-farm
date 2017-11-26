<?PHP

class db{


	private $con = false; // Идентификатор
	private $Queryes = 0; // Число запросов
	private $MySQLErrors = array(); // Массив с ошибками
	private $TimeQuery = 0; // Всемя запросов
	private $MaxExTime = 0; // Максимальное время за 1 запрос
	private $ListQueryes = ""; // Список запросов
	private $HardQuery = ""; // Самый тяжелый запрос
	private $LastQuery = false; // Ресурс запрос
	private $ConnectData = array(); // Данные соединения
	
	/*======================================================================*\
	Function:	__construct
	Descriiption: Выполняется при создании экземпляра класса
	\*======================================================================*/
	public function __construct($host, $user, $pass, $base){
		$this->Connect($host, $user, $pass, $base);
		$this->query("SET NAMES 'cp1251'");
		$this->query("SET CHARACTER SET 'cp1251'");
	}
	
	/*======================================================================*\
	Function:	Stats
	Descriiption: Возвращает статистику по запросам
	\*======================================================================*/
	public function Stats(){
		
		$sD = array();
		$sD["TimeQuery"] = $this->TimeQuery;
		$sD["MaxExTime"] = $this->MaxExTime;
		$sD["ListQueryes"] = $this->ListQueryes;
		$sD["HardQuery"] = $this->HardQuery;
		$sD["Queryes"] = $this->Queryes;
		return $sD;
	}

	/*======================================================================*\
	Function:	GetError
	Descriiption: Выводит описание ошибки в поток
	\*======================================================================*/
	private function GetError($TextError){
		$this->MySQLErrors[] = $TextError;
		die($TextError);
	}
	
	
	/*======================================================================*\
	Function:	query
	Descriiption: Запрос
	\*======================================================================*/	
	public function query($query, $FreeMemory = false, $write_last = true){
		
		$TimeA = $this->get_time();
		$xxt_res = mysqli_query($this->con, $query) or $this->GetError(mysqli_error($this->con));
		
		if($write_last) $this->LastQuery = $xxt_res;
		
		$TimeB = $this->get_time() - $TimeA;
		$this->TimeQuery += $TimeB;
		
			if($TimeB > $this->MaxExTime){$this->HardQuery = $query; $this->MaxExTime = $TimeB;}
			
				if( empty($this->ListQueryes) ) $this->ListQueryes = $query; else $this->ListQueryes .= "\n".$query;
			
		$this->Queryes++;
		
		if(!$FreeMemory){
			return $this->LastQuery;
		}else return $this->FreeMemory();
		
		
	}

	/*======================================================================*\
	Function:	Connect
	Descriiption: Соединяется с ДБ
	\*======================================================================*/	
	private function Connect($host, $user, $pass, $base){
		$this->con =  @mysqli_connect($host, $user, $pass, $base) or $this->GetError(mysqli_connect_error());
	} 
	
	
	/*======================================================================*\
	Function:	MultiQuery
	Descriiption: Множественный запрос
	\*======================================================================*/	
	function MultiQuery($query){
	
		$TimeA = $this->get_time();

		mysqli_multi_query($this->con, $query) or $this->GetError(mysqli_connect_error());
    	$TimeB = $this->get_time() - $TimeA;	
		$ret_data = array();
		$counter = 0;
			do{
        
				if ($result = mysqli_store_result($this->con)) {
					
					while ($row = mysqli_fetch_array($result)) {
					$ret_data[$counter][] = $row;
					}
					mysqli_free_result($result);
					$counter++;
				}

				
    		}while(mysqli_next_result($this->con));

		
		
		$this->TimeQuery += $TimeB;
			
			if($TimeB > $this->MaxExTime){$this->HardQuery = $query; $this->MaxExTime = $TimeB;}
			
				if( empty($this->ListQueryes) ) $this->ListQueryes = $query; else $this->ListQueryes .= "\n".$query;
			
		$this->Queryes++;
		
		return $ret_data;
	}
	
	/*======================================================================*\
	Function:	get_time
	Descriiption: Возвращает строку времени
	\*======================================================================*/	
	private function get_time()
	{
		list($seconds, $microSeconds) = explode(' ', microtime());
		return ((float) $seconds + (float) $microSeconds);
	}
	
	/*======================================================================*\
	Function:	__destruct
	Descriiption: Выполняется при уничтожении экземпляра класса
	\*======================================================================*/
	function __destruct(){
		
		if( !count($this->MySQLErrors) ) mysqli_close($this->con);
	
	}
	
	/*======================================================================*\
	Function:	FreeMemory
	Descriiption: Освобождает память
	\*======================================================================*/
	function FreeMemory()
	{
		$tr = ($this->LastQuery) ? true : false;
		@mysqli_free_result($this->LastQuery);
		return $tr;
	}
	
	/*======================================================================*\
	Function:	RealEscape
	Descriiption: Фильтрация )
	\*======================================================================*/
	function RealEscape($string)
	{
		if ($this->con) return mysqli_real_escape_string ($this->con, $string);
		else return mysql_escape_string($string);
	}
	
	/*======================================================================*\
	Function:	NumRows
	Descriiption: Подсчет числа строк
	\*======================================================================*/
	function NumRows()
	{
		return mysqli_num_rows($this->LastQuery);
	}
	
	/*======================================================================*\
	Function:	fetch_array
	Descriiption: Возвращ массив, создает циферные ключи...
	\*======================================================================*/
	function FetchArray(){
		//if($this->LastQuery)
		return mysqli_fetch_array($this->LastQuery);
	}
	
	/*======================================================================*\
	Function:	NumRows
	Descriiption: Возвращает результат
	\*======================================================================*/
	function FetchRow(){
		$xres = mysqli_fetch_row($this->LastQuery);
		
		return (count($xres) > 1) ? $xres :  $xres[0];
	}
	
	/*======================================================================*\
	Function:	LastInsert()
	Descriiption: Возвращает последний ID вставки
	\*======================================================================*/
	function LastInsert(){
		
		return @mysqli_insert_id($this->con);
		
	}
	
}
?>
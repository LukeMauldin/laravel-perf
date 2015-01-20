<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showview()
	{
		return View::make('hello');
	}

    public function simplejson()
    {
        $obj = ['name' => 'John', 'age' => 20];
        return Response::json($obj);
    }

    public function simpleeloquent($numIteration)
    { 
        for ($i = 0; $i < $numIteration; $i++) {
            $result = $this->eloquentquery();
        }   
        return Response::json($result);
    }

    public function simplepdo($numIteration)
    {
        for ($i = 0; $i < $numIteration; $i++) {
            $result = $this->pdoquery();
        }   
        return Response::json($result);
    }

    private $dbh = null;
    private $preparedStmt = null;
    private function pdoquery()
    {
        if ($this->dbh === null) {
            $mysqlConfig = Config::get('database.connections.mysql');
            $host = $mysqlConfig['host'];
            $user = $mysqlConfig['username'];
            $pass = $mysqlConfig['password'];
            $database = $mysqlConfig['database'];
            $this->dbh = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
            $sql = 'select * from users where id < 30';
            $this->preparedStmt = $this->dbh->prepare($sql);
        }
        $this->preparedStmt->execute();
        $result = $this->preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    private function eloquentquery()
    {
       return User::where('id', '<', 30)->get();
    }
}

<?php
namespace DataBase;
    require_once 'tools.php';
    use Tools\dataBase as db;
    use PDO;

    class Connect
    {
        private $connect;

        public function __construct($db_name){
            try {
                $db_tools = new db();
                $db_user = $db_tools->getUser();
                $db_pass = $db_tools->getPass();
                $db_host = $db_tools->getHost();
                $this->connect = new PDO("mysql:host=$db_host" . ";dbname=$db_name", $db_user, $db_pass);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->connect;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function getColumnTable($table, $column = "*")
        {
            try {
                $query = $this->connect->query("SELECT $column FROM $table");
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $id = 0;
                while ($ressult = $query->fetch()) {
                    $row[$id] = $ressult;
                    $id++;
                }
            } catch (PDOException $e) {
                $row = $e->getMessage();
            }
            return $row;
        }

        public function getRowTable($table, $where)
        {
            try {
                $query = $this->connect->query("SELECT * FROM $table WHERE $where");
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $id = 0;
                while ($ressult = $query->fetch()) {
                    $row[$id] = $ressult;
                    $id++;
                }
            } catch (PDOException $e) {
                $row = false;
            }
            return $row;
        }

        private function isDataInString($data, $spl, $str)
        {
            $arr = split($spl, $str);
            for ($i = 0; $i < count($arr); $i++)
                if (trim($arr[$i]) == $data)
                    return true;
            return false;
        }

        public function getSelectedRowTable($table, $where, $filter, $filter_val)
        {
            try {
                $query = $this->connect->query("SELECT * FROM $table WHERE $where");
                $query->setFetchMode(PDO::FETCH_ASSOC);
                $id = 0;
                while ($ressult = $query->fetch()) {
                    if ($this->isDataInString($filter_val, ';', $ressult[$filter])) {
                        $row[$id] = $ressult;
                        $id++;
                    }
                }
            } catch (PDOException $e) {
                $row = false;
            }
            return $row;
        }

        public function getById($id, $table)
        {
            $ress = $this->getRowTable($table, 'id=' . $id);
            return $ress;
        }

        public function insertDataTable($table, $values, $columns)
        {
            try {
                $query = "INSERT INTO $table (";
                if (is_array($columns)) {
                    for ($i = 1; $i < count($columns); $i++) {
                        $query .= "$columns[$i],";
                    }
                    $query .= "$columns[0]) VALUES (";
                    for ($i = 1; $i < count($values); $i++) {
                        $query .= "'$values[$i]',";
                    }
                    $query .= "'$values[0]')";
                } else {
                    $query .= "$columns ) VALUES ( '$values' )";
                }

                $result = $this->connect->prepare($query);
                $result->execute();
                $row = true;
            } catch (PDOException $e) {
                $row = $e->getMessage();
            }
            return $row;
        }

        public function setDataTable($table, $column, $value, $where)
        {
            try {
                $query = "UPDATE $table SET ";
                if (is_array($column)) {
                    for ($i = 1; $i < count($column); $i++) {
                        $query .= "$column[$i] = '$value[$i]', ";
                    }
                    $query .= "$column[0] = '$value[0]' WHERE $where";
                } else {
                    $query .= "$column = '$value' WHERE $where";
                }

                $result = $this->connect->prepare($query);
                $result->execute();
                $row = $result;
            } catch (PDOException $e) {
                $row = $e->getMessage();
            }
            return $row;
        }

        public function deleteRow($table, $where)
        {
            $this->connect->exec('DELETE FROM' . $table . ' WHERE' . $where);
        }

        public function createTable($sql)
        {
            try {
                $this->connect->exec($sql);
                return true;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
    }

//tarkik ☮ 2015
?>


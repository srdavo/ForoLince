<?php
require_once ("../controllers/Users.controller.php");
require_once("../config/cookies.php");

class Users extends Connect {

    public function login($username, $pwd, $cookie_uid, $cookie_pwd){   
        deleteCookies($cookie_uid, $cookie_pwd); // Delete cookies if they exist before login    
        $connect=parent::Conection();
        $userExists = $this->validateUserExists($connect, $username, $username);
        if($userExists === false){
           echo json_encode("user_doesnt_exist");
           exit;
        }

        $pwdHashed = $userExists["pwd"];
        $checkPwd = password_verify($pwd, $pwdHashed);
        if ($checkPwd === false) {
            echo json_encode("wrong_password");
            exit();
        } elseif ($checkPwd === true) {
            include_once("../config/session.php");
            // Setting cookies
            setcookie($cookie_uid, "$username",  time()+(10 * 365 * 24 * 60 * 60), "/");
            setcookie($cookie_pwd, "$pwd", time()+(10 * 365 * 24 * 60 * 60), "/");
            $_SESSION["id"] = $userExists["id"];
            $_SESSION["user"] = $userExists["name"];

            $additional_data = $this->getAdditionalUserData();
            $_SESSION["additional_data"] = $additional_data;
            return true;
        }
    }
    public function validateUserExists($connect, $name, $email){
        try {
            $sql = "SELECT * FROM users WHERE name = :name OR email = :email;";
            $sql = $connect->prepare($sql);
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->execute();
        
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            // if(count($result) > 0){
            //     return $result;
            // }else{
            //     return false;
            // }
            return ($result !== false) ? $result : false;
        } catch (PDOException $e) {
            // Manejar la excepción aquí (por ejemplo, imprimir el mensaje de error)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function generateToken(){
        $length = 8; 
        $token = bin2hex(random_bytes($length / 2));
        return $token;
    }
    public function signup($email, $pwd){
        $connect=parent::Conection();
        $name = null;
        $userExists = $this->validateUserExists($connect, $name, $email);

        if ($userExists !== false) {
            echo json_encode("user_already_exists");
            exit;
        }

        $user_token = $this->generateToken();
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        
        $sql_users = "INSERT INTO users (email, pwd) VALUES (?, ?);";
        $sql_tokens = "INSERT INTO users_data (user_id, user_token) VALUES (?, ?);";

        $stmt_users = $connect->prepare($sql_users);
        $stmt_tokens = $connect->prepare($sql_tokens);

        $stmt_users->bindParam(1, $email);
        $stmt_users->bindParam(2, $hashedPwd);

        $stmt_tokens->bindParam(1, $user_id);
        $stmt_tokens->bindParam(2, $user_token);
        
        try {
            $stmt_users->execute();
            $user_id = $connect->lastInsertId();
            $stmt_tokens->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }
    public function getUserData($userid) {
        $connect = parent::Conection();
    
        $sql = "SELECT users.*, users_data.* 
            FROM users
            LEFT JOIN users_data ON users.id = users_data.user_id
            WHERE users.id = ?;
        ";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $userid);
    
        try {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC); // Corrected method
    
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function modifyUserData($name, $userid){
        $connect = parent::Conection();

        $email = null;
        $userExists = $this->validateUserExists($connect, $name, $email);

        if ($userExists !== false) {
            echo json_encode("user_already_exists");
            exit;
        }

        $sql = "UPDATE users SET name = ? WHERE id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $userid);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    private function getAdditionalUserData(){
        $connect = parent::Conection();
        $sql = "SELECT * FROM users_data WHERE user_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $_SESSION["id"]);
        try {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getUsersData(){
        $connect = parent::Conection();
        $sql = "SELECT users* FROM users ";
        $stmt = $connect->prepare($sql);
        try {
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllUsersDataTable($original_user_permissions){
        $connect = parent::Conection();
        $sql = "SELECT users.*, users_data.* 
            FROM users
            LEFT JOIN users_data ON users.id = users_data.user_id;
        ";
        $stmt = $connect->prepare($sql);
        $response = "";
        $additional_button = ""; 
        $table_header = "
            <table>
            <tr>
                <td>Id de la cuenta</td>
                <td>Nombre</td>
                <td>Correo electrónico</td>
                <td>Nivel de permisos</td>
                <td>Créditos</td>
                <td></td>
            </tr>
        ";
        try {
            $stmt->execute();
            if ($stmt->rowCount() <= 0) {
                $response = "
                    <div class='content_box light centered'>
                        <span class='material-symbols-rounded pretty'>search_off</span>
                        <h1 class='info'>No hay usuarios</h1>
                    </div>
                ";
                return $response;
            }
            $response .= $table_header;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user_id = $row["id"];
                $user_name = $row["name"];
                $user_email = $row["email"];
                $user_permissions = $row["permissions"];
                $user_credits = $row["credits"];
                $user_permissions_formated = "";
                switch ($user_permissions) {
                    case '1':
                        $user_permissions_formated = "<span class='data-line secondary-container on-secondary-container-text'>Profesor</span>";
                        break;
                    case '7':
                        $user_permissions_formated = "<span class='data-line primary-container on-primary-container-text'>Administrador</span>";
                        break;
                    
                    default:
                        $user_permissions_formated = "<span class='data-line'>Estudiante</span>";
                        break;
                }

                
                if($original_user_permissions == "7"){
                    $additional_button = "
                        <button
                            data-flip-id='animate'
                            class='table-button small' 
                            data-user-permissions='$user_permissions' 
                            data-user-id='$user_id'
                            onclick='toggleEditUserPermissions(this);'>
                            <span class='material-symbols-rounded'>lock</span>
                        </button>    
                    ";
                }

                $response .= "
                    <tr>
                        <td>$user_id</td>
                        <td>$user_name</td>
                        <td>$user_email</td>
                        <td>$user_permissions_formated</td>
                        <td>$user_credits</td>
                        <td>
                            <button
                                data-flip-id='animate'
                                class='table-button small' 
                                data-user-credits='$user_credits' 
                                data-user-id='$user_id'
                                onclick='toggleEditUserCredits(this); '>
                                <span class='material-symbols-rounded'>toll</span>
                            </button>
                            <button
                                data-flip-id='animate'
                                class='table-button small' 
                                data-user-permissions='$user_permissions' 
                                data-user-id='$user_id'
                                onclick='toggleEditUserPermissions(this);'>
                                <span class='material-symbols-rounded'>lock</span>
                            </button>   
                        </td>
                    </tr>
                ";
            }

            
            $response .= "</table>";
            return $response;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function modifyUserCredits($user_id, $credits){
        $connect = parent::Conection();
        $sql = "UPDATE users_data SET credits = ? WHERE user_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $credits);
        $stmt->bindParam(2, $user_id);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function modifyUserPermissions($current_account_id, $user_id, $permissions){
        $connect = parent::Conection();
        $sql = "UPDATE users_data SET permissions = ? WHERE user_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(1, $permissions);
        $stmt->bindParam(2, $user_id);
        try {
            $stmt->execute();
            if($current_account_id == $user_id){
                $_SESSION["additional_data"]["permissions"] = $permissions;
            }
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>

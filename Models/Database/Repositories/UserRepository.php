<?php

require('../Entities/ITable.php');
// require('../../Utils/HandleImage/index.php');
// require('../../Utils/Bcrypt/index.php');

class UserRepository implements ITable 
{
    public function __construct($connection) {
        $this->connection = $connection;
    }

    private function makeInsertQuery($user) {
        $this->user = $user;

        if (property_exists($this->user, "photo")) {
            if ($this->user->photo != null) {
                $imagePath = handleImage($this->user->photo);
                unset($this->user->photo);
                $this->user->photo = $imagePath;
            }
        }

        $hashedPassword = Bcrypt::hash($this->user->password);
        unset($this->user->password);
        $this->user->password = $hashedPassword;

        $alreadyExists = "select * from usuario where login='$this->user->login'";
        $result = mysqli_query($this->connection, $alreadyExists);

        if (mysqli_num_rows($result) > 0) {
            ?>
            <scripts>
                alert('Usuário já existe');
                location.href="../../Views/Home/index.html";
            </scripts>
            <?php
        } else {
            // $sql = "insert into usuario (";
            // $values = "";

            // foreach($user as $key=>$value) {
            //     $sql = $sql.", ".$key;
            //     $values = $values.", ".$value;
            // }

            // $sql = $sql.")"." values(".$values.")";
            
            $sql = "insert into usuario () values ('$user->name', '$user->login', '$user->password', '$user->photo')";

            return $sql;
        }
    }

    public function test() {
        echo "test";
    }

    public function insert($user) {
        try {
            //$sql = $this->makeInsertQuery($user);
            $sql = "insert into usuario() values('$user->name', '$user->login', '$user->password', 'aaa')";
            echo $sql;

            if ($result = $this->connection->query($sql)) {
                echo "Returned rows are: " . $result -> num_rows;
                $result->free_result();
                ?>
                <script>
                    alert("Cadastro realizado com sucesso.");
                    location.href="../../Views/Home/index.html";
                </script>
                <?php
            } else {
                $result->free_result();
                ?>
                <script>
                    alert('Erro no cadastro');
                    location.href="../../Views/SignUp/index.html";
                </script>
                <?php
            }
        } catch (Exception $err) {
            ?>
            <script>
                alert('Erro no cadastro');
                location.href="../../Views/SignUp/index.html";
            </script>
            <?php
        }
    }

    public function update($user) {}

    public function delete($user) {}

    public function select($user) {}
}

?>
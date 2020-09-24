<?php
session_start();

class databases
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "Noel@123";
    public $database = "studmanagement";
    public $conn;
    const errno = 1062;


    /**
     * Function : Constructor
     *
     * Initialise connection
     *
     * Return:
     *
     * 1 if connection is established
     *
     * Error if connection cant be established
     *
     */

    public function __construct()
    {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn) {
            return 1;
        } else {
            return mysqli_connect_error();
        }
    }


    /**
     *Function: login
     *
     * to log into the system
     *
     * Parameters:
     *
     * @param $username
     * @param $password
     *
     * Returns:
     *
     * Return 1 if type of user is student
     *
     * Return 3 if type of user is Institution
     *
     * Exception:
     *
     * Throws an exception Invalid Username or password when there is any username and password mismatch
     *
     * Throws an exception Server busy Try again If server refuses to execute the sql query
     *
     */

    public function login($username, $password)
    {
        $sql = "SELECT * FROM tbl_login WHERE email = '$username' AND password = '$password'";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($row = mysqli_fetch_assoc($result)) {
                $type = $row['type'];
                $_SESSION['username'] = $username;
                $p = $row['password'];
                $_SESSION['logid'] = $row['logid'];
                $_SESSION['type'] = $type;
                $_SESSION['id'] = Session_id();
            } else {
                throw new Exception('Invalid username or password');
            }
            if (($type == "student") && ($p == $password)) {

                return 1;

            } else if (($type == "inst") && ($p == $password)) {
                return 3;
            }
        } else {
            throw new Exception('Server Busy Try again fter Sometime');
        }
    }


    /**
     * Function : Course
     *
     * To display courses available in student registration form
     *
     * Return:
     *
     * @return array $course
     *
     * Exception:
     *
     * Throws an exception as cant display now if sql refuses to execute
     *
     */

    public function course()
    {
        $sql = "SELECT * FROM tbl_course WHERE status = 1";
        if ($result = mysqli_query($this->conn, $sql)) {
            $course = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $k = $row['cid'];
                $k1 = $row['course_name'];
                $course[$k] = $k1;
            }
            return $course;
        } else {
            throw new Exception('Cant Display Now');
        }
    }


    /**
     * Function: Regstud
     *
     * function used to register a student
     * Parameter:
     *
     *  $para as an  array of values
     *
     * Return:
     *
     * return 1 if student is registered sucessfully
     *
     * Exception:
     *
     * throws an exception if email id provided by the student is already present in the database
     *
     */

    public function regstud($para)
    {
        $count = count($para);
        $sql = "INSERT INTO tbl_login (email,password) VALUES('$para[1]','$para[6]')";

        if (mysqli_query($this->conn, $sql)) {
            $logid = $this->conn->insert_id;
            $sql = "INSERT INTO tbl_stud_registration (username,address,dob,gender,courseid,logid) VALUES('$para[0]','$para[2]','$para[3]','$para[4]','$para[5]','$logid')";
            if (mysqli_query($this->conn, $sql)) {
                return 1;
            }
        } else {
            $err_no = mysqli_errno($this->conn);
            if ($err_no == self::errno) {
                throw new Exception('Email Id is alredy registered Try log in or register using another Email Id');
            }
        }
    }


    /**
     * Function: display
     *
     * function to display the details of student
     *
     * Return:
     *
     * @return string[]|null as $row with details of the student
     *
     * Exception:
     *
     * Throws an Exception if sql refuses to execute
     */

    public function display()
    {
        $logid = $_SESSION['logid'];
        $sql = "SELECT * FROM tbl_stud_registration LEFT JOIN tbl_course ON tbl_stud_registration.courseid = tbl_course.cid  LEFT JOIN tbl_login ON tbl_stud_registration.logid = tbl_login.logid WHERE tbl_stud_registration.logid = '$logid' AND tbl_stud_registration.status = 1";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
        } else {
            throw new Exception('Cant Display Details');
        }
    }


    /**
     * Function: editstud
     *
     * function to edit details of a student
     *
     * Parameters:
     *
     * $det with values of the values
     *
     * Return:
     *
     * return 1 if query executed successfully
     *
     *Exception:
     *
     *throws an exception if Email id already exists in a database
     */

    public function editstud($det)
    {
        $logid = $_SESSION['logid'];
        $sql = "UPDATE tbl_login SET email = '$det[1]' WHERE logid = '$logid';";
        $sql .= "UPDATE tbl_stud_registration SET username = '$det[0]',address = '$det[2]',dob = '$det[3]',gender = '$det[4]' WHERE logid = '$logid'";

        if ($this->conn->multi_query($sql) === TRUE) {
            return 1;
        } else {
            $err_no = mysqli_errno($this->conn);
            if ($err_no == 1062) {
                throw new Exception('Email Id alredy exist');
            }
        }
    }


    /**
     * Function: passupdate
     *
     * function to update password of student and institution
     *
     * Parameters:
     *
     * $pass with the new password
     *
     * Return:
     *
     * return 1 is password gets updated successfully
     *
     * Exception:
     *
     * throws an exception is any sql error occurs
     */
    public function passupdate($pass)
    {
        $logid = $_SESSION['logid'];
        $sql = "UPDATE tbl_login SET password = '$pass' WHERE logid = '$logid'";
        if (mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            throw new Exception('Cant Update Now');
        }
    }


    /**
     * Function: reginst
     *
     *function to register an institution
     *
     *Parameters:
     *
     * $para with values to register
     *
     * Return:
     *
     * returns 1 if query gets executed
     *
     * Exception:
     *
     * throws an exception if email id already exists in the database
     *
     */
    public function reginst($para)
    {
        $count = count($para);
        $sql = "INSERT INTO tbl_login (email,password,type) VALUES('$para[1]','$para[3]','Inst')";
        if (mysqli_query($this->conn, $sql)) {
            $logid = $this->conn->insert_id;
            $sql = "INSERT INTO tbl_manage_registration (management_username,address,mlogid) VALUES('$para[0]','$para[2]','$logid')";
            echo $sql;
            if (mysqli_query($this->conn, $sql)) {
                return 1;
            }
        } else {
            $err_no = mysqli_errno($this->conn);
            if ($err_no == self::errno) {
                throw new Exception('Email Id already exists');
            }
        }
    }


    /**
     * Function displayinst
     *
     * function to display details of institution
     *
     * Return:
     *
     * return $row with values of institution
     *
     * Exception:
     *
     * throws an exception if there occurs any sql errors
     *
     */
    public function displayinst()
    {
        $logid = $_SESSION['logid'];
        $sql = "SELECT * FROM tbl_manage_registration LEFT JOIN tbl_login ON tbl_manage_registration.mlogid = tbl_login.logid WHERE tbl_manage_registration.mlogid = '$logid' AND tbl_manage_registration.status = 1";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
        } else {
            throw new Exception('cant Display now');
        }
    }


    /**
     * Function displaystud
     *
     * function to list students inside institution
     *
     * Return:
     *
     * returns $x as array having details of student
     *
     * Exception:
     *
     * throws an exception if there occurs any sql errors
     *
     */
    public function displaystud()
    {
        $logid = $_SESSION['logid'];
        $sql = "SELECT logid, username FROM tbl_stud_registration LEFT JOIN tbl_manage_registration ON tbl_manage_registration.manageid = tbl_stud_registration.manageid WHERE tbl_manage_registration.mlogid = '$logid' AND tbl_stud_registration.status = 1";
        $details = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $logid = $row['logid'];
                $u_name = $row['username'];
                $details[$logid] = $u_name;
            }
            return $details;
        } else {
            throw new Exception('cant display details right now');
        }
    }


    /**
     * Function displaypro
     *
     * function to list all details of a student inside institution
     *
     * Parameters:
     *
     * $logid with log id of institution to display details of students registered
     *
     *
     * Returns:
     *
     * return $row with details of the student
     *
     * Exeception:
     *
     * throws an exception if aby sql error occurs
     *
     */
    public function displaypro($logid)
    {
        $sql = "SELECT * FROM tbl_stud_registration LEFT JOIN tbl_course ON tbl_stud_registration.courseid = tbl_course.cid  LEFT JOIN tbl_login ON tbl_stud_registration.logid = tbl_login.logid WHERE tbl_stud_registration.logid = '$logid' AND tbl_stud_registration.status = 1";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }
        } else {
            throw new Exception('Cant Display right Now');
        }
    }


    /**
     * Function: editprostud
     *
     * function to edit student profile inside institution
     *
     * Parameters:
     *
     * $det with id of student to edit details
     *
     * Returns:
     *
     * return 1 if details updated successfully
     *
     * Exception:
     *
     * throws an exception if any sql error occurs
     *
     */
    public function editprostud($det)
    {
        $logid = $det['6'];
        $sql = "UPDATE tbl_login SET email = '$det[1]' WHERE logid = '$logid';";
        $sql .= "UPDATE tbl_stud_registration SET username = '$det[0]',address = '$det[2]',dob = '$det[3]',gender = '$det[4]',courseid = '$det[5]' WHERE logid = '$logid'";
        if ($this->conn->multi_query($sql) === TRUE) {
            return 1;
        } else {
            $err_no = mysqli_errno($this->conn);
            if ($err_no == 1062) {
                throw new Exception('Email Id is alredy registered Try log in or register using another Email Id');
            }
        }
    }


// function to delete a course from institution

    /**
     * Function: deletecourse
     *
     * function to delete a course from institution
     *
     * Parameter
     *
     * $det with  course id of course to be deleted
     *
     * Returns:
     *
     * returns 1 if deleted successfully
     *
     * Exception:
     *
     * throws an exception if any sql errors occurs
     *
     */
    public function deletecourse($det)
    {
        $id = $det;
        $sql = "UPDATE tbl_course SET status = 0 WHERE cid = '$id'";
        if ($result = mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            throw new Exception('cant Delete Now');
        }
    }


//function to add a course from institution

    /**
     * Function: addcourse
     *
     * function to add a course from institution
     *
     * Parameters:
     *
     * $det with course name
     *
     * Returns:
     *
     * returns 1 if query executed successfully
     *
     * Exception:
     *
     * throws an exception if any sql errors occurs
     *
     */
    public function addcourse($det)
    {
        $name = $det;
        $sql = "INSERT INTO tbl_course(course_name) VALUES ('$name')";
        if ($result = mysqli_query($this->conn, $sql)) {
            return 1;
        } else {
            throw new Exception('cant Add now');
        }
    }


// function to delete a student from institution

    /**
     * Function: deletestud
     *
     * function to delete student from institution
     *
     * Parameters:
     *
     * $det with id of the student to be deleted
     *
     * Return:
     *
     * returns 1 if student get deleted
     *
     * Exception:
     *
     * throws an exception if any sql errors occurs
     *
     */
    public function deletestud($det)
    {
        $id = $det;
        $sql = "UPDATE tbl_login SET status = 0 WHERE logid = '$id';";
        $sql .= "UPDATE tbl_stud_registration SET status = 0 WHERE logid = '$id'";
        if ($this->conn->multi_query($sql) === TRUE) {
            return 1;
        } else {
            throw new Exception('Cant Delete Now');
        }
    }



    // function to fetch log id of manage id from table

    /**
     * Function manage
     *
     * function to fetch manage id of log id
     *
     * Return:
     *
     * Return $manageid with value manage id of log id
     *
     */
    public function manage()
    {
        $logid = $_SESSION['logid'];
        $sql = "SELECT manageid FROM tbl_manage_registration where mlogid = '$logid'";
        if ($result = mysqli_query($this->conn, $sql)) {
            if ($row = mysqli_fetch_assoc($result)) {
                $manageid = $row['manageid'];
            }
            return $manageid;
        }
    }




// function to display selected course in student profile edit from Institution

    /**
     * Function coruseed
     * function to display selected course of a student inside institution
     *
     * Parameters:
     *
     * $studid with userid of student from student registration table
     *
     * Returns
     *
     * returns an array with course id and course name
     *
     */
    public function coursed($cid)
    {
        $cid = $cid;
        $sql = "SELECT * FROM `tbl_course` ORDER BY CASE WHEN cid = '$cid' THEN NULL ELSE cid END ASC";
        $result = mysqli_query($this->conn, $sql);
        $course = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $courseid = $row['cid'];
            $coursename = $row['course_name'];
            $course[$courseid] = $coursename;
        }
        return $course;
    }
}

?>

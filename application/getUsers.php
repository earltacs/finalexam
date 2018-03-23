<?php
    include("functions.php");
    $result = $db->query("SELECT username, lastname, LEFT(middlename, 1) AS mname, LEFT(firstname, 1) AS fname, `type` FROM accounts");
    echo "<table id='user-table'>
            <tr>
                <th> Username </th>
                <th> Name </th>
                <th> Type </th>
            </tr>";
    if(mysqli_num_rows($result) != 0){
        $data = $result->fetch_all(MYSQLI_ASSOC);
        foreach( $data as $value ){
            echo "<tr>
                    <td> ".$value['username']." </td>
                    <td> ".$value['lastname'].", ".$value['mname']." ".$value['fname']." </td>
                    <td>
                        <select id='role' class='".$value['username']."' onchange='onSelect(this)'>";
                        if(strcmp($value['type'], "SU") == 0){
                            echo "<option value=".$value['type']."> Super Admin </option>
                                <option value='OU'> Organization Admin </option>
                                <option value='NU'> Standard User </option>";
                        }else if(strcmp($value['type'], "OU") == 0){
                            echo "<option value=".$value['type']."> Organization Admin </option>
                                <option value='SU'> Super Admin </option>
                                <option value='NU'> Standard User </option>";
                        }else{
                            echo "<option value=".$value['type']."> Standard User </option>
                                <option value='SU'> Super Admin </option>
                                <option value='OU'> Organization Admin </option>";
                        }
                        echo"</select>
                     </td>
                </tr>";
        }
    }
    echo "</table>";
?>
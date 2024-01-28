<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>MSL Payroll</title>
    </head>

    <body bgcolor="#ECE9D8">
        <div style="margin:30px 20px; width:100%; height:auto; overflow:hidden; text-align:left;">
            <table>
                <tr style="margin: 3px 3px !important;">
                    <th>Sl.</th>
                    <th>Emp Id</th>
                    <th>Emp Name</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Line</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
                <style>
                    .btn {
                        padding: 5px 10px;
                        background: #e31f1f;
                        color: #fff;
                        border-radius: 10%;
                        cursor: pointer;
                        text-decoration: none;
                    }
                </style>
                <?php foreach ($data as $key => $r) { ?>
                    <tr style="margin: 3px 3px !important;">
                        <td style="padding: 3px !important;"><?= $key + 1 ?></td>
                        <td style="padding: 3px !important;"><?= $r->emp_id ?></td>
                        <td style="padding: 3px !important;"><?= $r->emp_full_name ?></td>
                        <td style="padding: 3px !important;"><?= $r->dept_name ?></td>
                        <td style="padding: 3px !important;"><?= $r->sec_name ?></td>
                        <td style="padding: 3px !important;"><?= $r->line_name ?></td>
                        <td style="padding: 3px !important;"><?= $r->desig_name ?></td>
                        <td class="btn" onclick="deleteData('<?=$r->emp_id?>')" >delete</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>

<script>
    function deleteData(id) {
        if (confirm('Are You Sure to Delete the record permanently')) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo base_url();?>index.php/setup_con/delete_emp_id", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    window.location.reload();
                }
            };
            var data = "id=" + id;
            xhr.send(data);
        } else {
            alert("You canceled!");
        }
    }


</script>

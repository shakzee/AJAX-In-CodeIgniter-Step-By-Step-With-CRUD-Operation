<!DOCTYPE html>
<html>
<head>
    <title>Crud in AJAX</title>
</head>
<body>
        <?php if($this->session->flashdata('error')){
            echo $this->session->flashdata('error');
        }?>
        <?php echo form_input('name','',array('class'=>'name','placeholder'=>'Enter your Name'));?>
        <?php echo form_input('email','',array('class'=>'email','placeholder'=>'Enter your Email'));?>
        <?php echo form_input('password','',array('class'=>'password','placeholder'=>'Enter your Password'));?>
        <?php echo form_submit('Submit','Sumbit','class="mysubmit"');?>
        <div class="feedback">

        </div>
        <br>
        <div class="dycondiv"></div>

        <div>
            <br>
            <br><br><br>
            <table border="1" class="mytable">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
                <?php if($allRecords): ?>
                    <?php foreach($allRecords->result() as $std): ?>
                            <tr class="tr<?php echo $std->stId; ?>">
                                <td class="dyid<?php echo $std->stId; ?>">
                                    <?php echo $std->stId;?>
                                </td>
                                <td class="dyName<?php echo $std->stId; ?>">
                                    <?php echo $std->stName;?>
                                </td>
                                <td class="dyemail<?php echo $std->stId; ?>">
                                    <?php echo $std->stEmail;?>
                                </td>
                                <td>
                                    <?php echo $std->stDate;?>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-text="<?php echo $this->encryption->encrypt($std->stId)?>" data-id="<?php echo $std->stId;?>" class="edit">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" data-text="<?php echo $this->encryption->encrypt($std->stId)?>" data-id="<?php echo $std->stId;?>" class="delete">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                <?php else: ?>
                    data not exist
                <?php endif; ?>
            </table>
        </div>

        <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
        <script>
            var srul = "<?php echo site_url();?>";
        </script>
    <script src="<?php echo base_url('assets/js/custom.js');?>"></script>

</body>
</html>
<?php
if($_FILES['upload_file']['name'] != '')
{
    $data = explode(".",$_FILES['upload_file']['name']);
    $extension = $data[1];
    $allowed_extentions = array("jpg","png","gif");
    if(in_array($extension,$allowed_extentions))
    {
        $new_file_name = rand().".".$extension;
        $path = "Drive/".$_POST['hidden_folder_name']."/".$new_file_name;
        if(move_uploaded_file($_FILES['upload_file']['tmp_name'],$path))
        {
            echo "Image Uploaded";
        }
        else 
        {
            echo "Error Uploading File";
        }

    }
    else 
    {
        echo "Invalid Image File!";
    }
}
else 
{
    echo "Please Select an Image!";
}
?>
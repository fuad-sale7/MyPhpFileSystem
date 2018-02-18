<?php

function format_folder_size($size)
{
    if($size > 1073741824)
    {
        $size = number_format($size / 1073741824 , 2)." GB";
    }
    elseif ($size > 1048576)
    {
        $size = number_format($size / 1048576 , 2)." MB";
    }
    elseif ($size > 1024)
    {
        $size = number_format($size / 1024 , 2)." KB";
    }
    elseif ($size > 0)
    {
        $size = $size." byte";
    }
    else 
    {
        $size = "0 bytes";
    }

    return $size;
}

function get_folder_size($folder_name)
{
    $total_size = 0;
    $file_data = scandir($folder_name);
    
    foreach($file_data as $file)
        {
            if($file === '.' or $file === '..')
                {
                    continue;
                }
                else 
                {
                    $path = $folder_name.'/'.$file;
                    $total_size = $total_size + filesize($path);
                }
        }

        return format_folder_size($total_size);
}

if(isset($_POST["action"]))
{
    if($_POST["action"]=="fetch")
    {
        $folder = array_filter(glob('Drive/*'),'is_dir');
        $output = '
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Folder Name</th>
                <th>Total Filed</th>
                <th>Size</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Upload File</th>
                <th>View Uploaded Files</th>
            </tr>
        ';
    
        if(count($folder) > 0)
        {
            foreach($folder as $name1)
            {
                $name = substr($name1, 6, strlen($name1) - 6);
                $output .='
                    <tr>
                        <td>'.$name.'</td>
                        <td>'.(count(scandir($name1)) - 2).'</td>
                        <td>'.get_folder_size($name1).'</td>
                        <td><button type="button" name="update"
                            data-name="'.$name.'" class="update btn 
                            btn-outline-warning btn-block btn-sm">Update</button></td>
                        <td><button type="button" name="delete"
                            data-name="'.$name.'" class="delete btn 
                            btn-outline-danger btn-block btn-sm">Delete</button></td>
                        <td><button type="button" name="upload"
                            data-name="'.$name.'" class="upload btn 
                            btn-outline-info btn-block btn-sm">Upload</button></td>
                        <td><button type="button" name="view_files"
                            data-name="'.$name.'" class="view_files btn 
                            btn-outline-secondary btn-block btn-sm">View Files</button></td>
                    </tr>
                ';
            }
        }
        else 
        {
            $output .='<tr>
                    <td colspan="7">No Folders was Found</td>
            </tr>';
        }
        
        $output .='</table>';
        echo $output;
    }

    if($_POST["action"]=="create")
    {
        if(!file_exists("Drive/".$_POST['folder_name']))
        {
            mkdir("Drive/".$_POST['folder_name'],0777,true);
            echo "Folder Created!";
        }
        else 
        {
            echo "Folder Already Exists!";
        }
    }

    if($_POST["action"]=="change")
    {
        if(!file_exists("Drive/".$_POST['folder_name']))
        {
            rename("Drive/".$_POST['old_name'],"Drive/".$_POST['folder_name']);
            echo "Folder Renamed!";
        }
        else 
        {
            echo "Folder Already Created!";
        }
    }

    if($_POST["action"]=="delete")
    {
        $folder = "Drive/".$_POST['folder_name'];
        $files = scandir($folder);
        foreach($files as $file)
        {
            if($file === '.' or $file === '..')
            {
                continue;
            }
            else 
            {
                unlink($folder.'/'.$file);
            }
        }

        if(rmdir($folder))
            echo "Folder Deleted!";
    }

    if($_POST["action"]=="fetch_files")
    {
        $folder = "Drive/".$_POST['folder_name'];
        $files = scandir($folder);

        $output = '
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>Image</th>
                <th>File Name</th>
                <th>Size</th>
                <th>Delete</th>
            </tr>
        ';

        foreach($files as $file)
        {
            if($file === '.' or $file === '..')
            {
                continue;
            }
            else 
            {
                $path = $folder.'/'.$file;
                $total_size = filesize($path);
                $total_size =  format_folder_size($total_size);

                $output .='
                <tr>
                    <td><img src="'.$path.'" class="img-thumbnail" heigh="50" width="50" /></td>
                    <td contenteditable="true" data-folder_name="'.$folder.'" 
                    data-file_name="'.$file.'" class="change_file_name">'.$file.'</td>
                    <td>'.$total_size.'</td>
                    <td><button type="button" name="remove_file"
                            data-name="'.$path.'" class="remove_file btn 
                            btn-outline-danger btn-block btn-sm">Remove</button></td>
                ';
            }

        }

        $output .='</table>';
        echo $output;
    }


    if($_POST["action"]=="remove_file")
    {
        $path = $_POST['path'];
        unlink($path);
        echo "File Removed!";
    }

    if($_POST["action"]=="change_file_name")
    {
        $old_name = $_POST['folder_name']."/".$_POST["old_file_name"];
        $new_name = $_POST['folder_name']."/".$_POST["file_name"];
        if(file_exists($old_name))
        {
            if(rename($old_name,$new_name))
            {
                echo "File Renamed";
            }
            else 
            {
                echo "Error Renaming The Name!";
            }
        }
    }
}
?>
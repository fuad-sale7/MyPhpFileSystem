<div class="alert alert-info container" role="alert">
  Simple PHP File System by: <a href="http://www.facebook.com/fuad.works" target="_blank" class="alert-link">Fuad Mehawish</a>.<hr/>
  <strong>Credits:</strong><br/>
  <a href="https://getbootstrap.com/" target="_blank" class="alert-link">Bootstrap 4</a><br/>
  <a href="https://lipis.github.io/bootstrap-sweetalert/" target="_blank" class="alert-link">SweetAlert for Bootstrap</a><br />
  <a href="https://www.youtube.com/playlist?list=PLxl69kCRkiI3QawRIaYVCkW1H1IKd1359" target="_blank" class="alert-link">PHP Filesystem Tutorial |YouTube|</a>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/offcanvas.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
  </body>
</html>

<script>

  function load_folder_list()
  {
      var action = "fetch";
      $.ajax({
          url:"action.php",
          method: "POST",
          data: {action:action},
          success: function(data)
          {
              $("#folder_table").html(data);
          }
      });
  } 

  $(document).ready(function(){
      load_folder_list();     
  });

  $(document).on('click','#create_folder',function(){
    $('#action').val("create");
    $('#folder_name').val("");
    $("#folder_button").text("Create");
    $('#old_name').val("");
    $('#change_title').text("Create Folder");
    $("#folderModal").modal('show');
  });

  $(document).on('click','#folder_button',function(){
    var folder_name = $('#folder_name').val();
    var action = $('#action').val();
    var old_name = $("#old_name").val();
    if(folder_name != '')
    {
      $.ajax({
                url:"action.php",
                method: "POST",
                data: {folder_name: folder_name, action:action, old_name:old_name},
                success: function(data)
                {
                  $("#folderModal").modal('hide');
                  load_folder_list();
                  swal(data);
                }
            });
    }
    else 
    {
      swal("Please Write Folder Name");
    }
  });

  $(document).on("click",'.update',function(){
    var folder_name = $(this).data("name");
    $('#action').val("change");
    $('#folder_name').val(folder_name);
    $("#folder_button").text("Update");
    $('#old_name').val(folder_name);
    $('#change_title').text("Rename Folder");
    $("#folderModal").modal('show');
  });


  $(document).on("click",'.delete',function(){
    var folder_name = $(this).data("name");
    var action = "delete";
    swal({
            title: "Are you sure?",
            text: "Are you sure you want to do this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            closeOnConfirm: false
          },
          function(){
            $.ajax({
                url:"action.php",
                method: "POST",
                data: {folder_name: folder_name, action:action},
                success: function(data)
                {
                  load_folder_list();
                  swal(data);
                }
            });
          });
  });

  $(document).on("click",'.upload',function(){
    var folder_name = $(this).data("name");
    $('#hidden_folder_name').val(folder_name);
    $("#uploadModal").modal('show');
  });

  $("#upload_form").on("submit",function(){
    $.ajax({
                url:"upload.php",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData:false,
                success: function(data)
                {
                  load_folder_list();
                  swal(data);
                }
            });
  });

  $(document).on("click",'.view_files',function(){
    var folder_name = $(this).data("name");
    var action = "fetch_files";
    $.ajax({
          url:"action.php",
          method: "POST",
          data: {action:action,folder_name:folder_name},
          success: function(data)
          {
              $("#file_list").html(data);
              $("#fileListModal").modal('show');
          }
      });
  });


  $(document).on("click",'.remove_file',function(){
    var path = $(this).data("name");
    var action = "remove_file";
    swal({
            title: "Are you sure?",
            text: "Are you sure you want to do this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            closeOnConfirm: false
          },
          function(){
            $.ajax({
                          url:"action.php",
                          method: "POST",
                          data: {path: path, action:action},
                          success: function(data)
                          {
                            $("#fileListModal").modal('hide');
                            load_folder_list();
                            swal(data);
                          }
                      });
          });
  });

  $(document).on('blur','.change_file_name',function(){
    var folder_name = $(this).data("folder_name");
    var old_file_name = $(this).data("file_name");
    var file_name = $(this).text();
    var action = "change_file_name";
    if(old_file_name == file_name)
      return;
    $.ajax({
      url:"action.php",
      method:"POST",
      data: {folder_name:folder_name,
              old_file_name:old_file_name,
              file_name:file_name,
              action:action},
      success:function(data)
      {
        swal(data);
      }

    });
  });

</script>
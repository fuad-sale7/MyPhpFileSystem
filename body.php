<main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
        <img class="mr-3" src="assets/img/logo.png" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">My File System</h6>
          <small>Since 2018</small>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded box-shadow">
        <h6 class="border-bottom border-gray pb-2 mb-0">Folder List</h6>
       
        <small class="d-block text-right mt-3">
        <div align="right">
        <button type="button" name="create_folder"
                            data-name="create_folder" id="create_folder" class="create_folder btn 
                            btn-outline-success btn-lg">Create Folder</button>
        </div>
        </small>

        <div class="media pt-3">
        <div id="folder_table" class="table-responsive">

        </div>
        </div>

        </div>
    </main>


<!-- Modal -->
<div class="modal fade" id="folderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="change_title"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p>
              Enter Folder Name <hr/>
              <input type="text" name="folder_name" id="folder_name" class="form-control" />
              <br/>
              <input type="hidden" name="action" id="action" />
              <input type="hidden" name="old_name" id="old_name"/>
          </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" name="folder_button" id="folder_button" class="btn btn-primary">Create</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="upload_form" enctype="multipart/form-data">
        <p>Select Image 
            <input type="file" name="upload_file" class="form-control" /><br/>
            <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" />
            <input type="submit" name="upload_button" value="Upload" class="btn btn-success" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="fileListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">File List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="file_list">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

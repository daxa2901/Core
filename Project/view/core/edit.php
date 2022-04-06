<!-- <form action="<?php //echo  $this->getEditUrl() ?>" method="POST" class="p-2" id='form-data'> -->
<!-- </form> -->

<div class="content-wrapper" style="min-height: 100.8px;">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $this->getTab()->getSelectedTab()['title']; ?></h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center">Tabs</h3>
                <ul class="list-group list-group-unbordered mb-3">
					<?php echo $this->getTab()->toHtml(); ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><?php echo $this->getTab()->getSelectedTab()['title']; ?></a></li>
                </ul>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity tabcontent">
                    <!-- Post -->
				<?php echo $this->getTabContent()->toHtml(); ?>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
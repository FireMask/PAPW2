<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/js/dist/AdminLTE/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Andres Lira</p>
                <!-- Status -->
                <a href=""><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Administrador</li>
            <li class="treeview">
                <a href="/cotizacion"><i class="fa fa-file-text"></i> <span>Cotizaciones</span></a>
            </li>
            <li class="treeview">
                <a href="/cliente"><i class="fa fa-users"></i> <span>Clientes</span></a>
            </li>
            <li class="treeview">
                <a href="/producto"><i class="fa fa-shopping-basket"></i> <span>Productos</span></a>
            </li>
            <li class="treeview">
                <a href="/usuario"><i class="fa fa-user"></i> <span>Usuarios</span></a>
            </li>
            <li class="treeview">
                <a href="/moneda"><i class="fa fa-money"></i> <span>Monedas</span></a>
            </li>
            <li class="treeview">
                <a href="/rol"><i class="fa fa-tags"></i> <span>Roles</span></a>
            </li>
            <li class="treeview">
                <a href="/proveedor"><i class="fa fa-truck"></i> <span>Proveedores</span></a>
            </li>
            <li class="treeview">
                <a href="/fabricante"><i class="fa fa-wrench"></i> <span>Fabricantes</span></a>
            </li>
            <li class="treeview">
                <a href="/empresa"><i class="fa fa-gear"></i> <span>Empresa</span></a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:;">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="pull-right-container">
                                <span class="label label-danger pull-right">70%</span>
                            </span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->

<div class="control-sidebar-bg"></div>

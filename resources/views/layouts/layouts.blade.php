<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ asset('/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('/css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name','Quan Ly Tai Chinh') }}</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      @auth
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ route('wallet.index') }}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Wallets</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ route('transaction.index') }}">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Transactions</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Transaction Categories</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="{{ route('category.spendIndex') }}">Spend</a>
            </li>
            <li>
              <a href="{{ route('category.receiveIndex') }}">Receive</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{ route('transaction.showReport') }}">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Report</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      @endauth
      <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div>
        </li>
        {{-- <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li> --}}
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.information') }}">
                    {{ __('User Information') }}
                </a>

                <a class="dropdown-item" href="{{ route('user.password') }}">
                    {{ __('Change Password') }}
                </a>

                <a class="dropdown-item" href="/logout"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endauth
      </ul>
    </div>
  </nav>
  @auth
  <div class="content-wrapper">
    <div class="container-fluid">
      @endauth
      @yield('content')
      @auth
    </div>
  </div>
  @endauth
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
  @auth
  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>Copyright © Vu Thanh Hai 2018</small>
      </div>
    </div>
  </footer>
  @endauth
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/datatables/dataTables.bootstrap4.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('/js/sb-admin.min.js') }}"></script>
  <!-- Custom scripts for this page-->
  <script src="{{ asset('/js/sb-admin-datatables.min.js') }}"></script>
  <script src="{{ asset('/js/sb-admin-charts.min.js') }}"></script>
  <script>
    $('#walletTable').dataTable( {
          "language": {
            "emptyTable": "You don't have any Wallet",
            "lengthMenu":     "Show _MENU_ Wallets",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Wallets",
            "infoEmpty":      "Showing 0 to 0 of 0 Wallets"
          },
          "columnDefs": [
            { "orderable": false, "targets": [3,4] }
          ]
    } );

    $('#walletTransactionTable').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transfer",
            "lengthMenu":     "Show _MENU_ Transfers",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transfer",
            "infoEmpty":      "Showing 0 to 0 of 0 Transfer"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#spendTransactionTable').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Transactions",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transactions",
            "infoEmpty":      "Showing 0 to 0 of 0 Transactions"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#receiveTransactionTable').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Transactions",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transactions",
            "infoEmpty":      "Showing 0 to 0 of 0 Transactions"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#speTransactionTableCat').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Transactions",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transactions",
            "infoEmpty":      "Showing 0 to 0 of 0 Transactions"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#recTransactionTableCat').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Transactions",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transactions",
            "infoEmpty":      "Showing 0 to 0 of 0 Transactions"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#recTransactionTableMon').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Transactions",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transactions",
            "infoEmpty":      "Showing 0 to 0 of 0 Transactions"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#speTransactionTableMon').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Transactions",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Transactions",
            "infoEmpty":      "Showing 0 to 0 of 0 Transactions"
          },
          "columnDefs": [
            { "orderable": false, "targets": [6,7] }
          ]
    } );

    $('#reportSpendTable').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Categories",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Categories",
            "infoEmpty":      "Showing 0 to 0 of 0 Category"
          }
    } );

    $('#reportReceiveTable').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Categories",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Categories",
            "infoEmpty":      "Showing 0 to 0 of 0 Category"
          }
    } );

    $('#reportSpendTableMonth').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Categories",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Categories",
            "infoEmpty":      "Showing 0 to 0 of 0 Category"
          }
    } );

    $('#reportReceiveTableMonth').dataTable( {
          "language": {
            "emptyTable": "You don't have any Transaction",
            "lengthMenu":     "Show _MENU_ Categories",
            "info":           "Showing _START_ to _END_ of _TOTAL_ Categories",
            "infoEmpty":      "Showing 0 to 0 of 0 Category"
          }
    } );
  </script>

</body>
</html>

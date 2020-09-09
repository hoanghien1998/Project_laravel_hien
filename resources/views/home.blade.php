@extends('layouts.layouts')
@section('content')
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://hien-web.service.docker/">WebSite Bid Cars</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://hien-web.service.docker/car">List cars</a></li>
                <li><a href="#">My Bid</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="/action_page.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://hien-web.service.docker/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav>

@endsection

@section('script')
    <script type="text/javascript">

@endsection

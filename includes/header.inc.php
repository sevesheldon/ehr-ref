    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">EHR</a>
            </div>

<?php if (isLoggedIn($return)): ?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#cc">Chief Complaint</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#mdm">Medical Decision Making</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#history">History</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#exam">Physical Exam</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#psychotherapy">Psychotherapy</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
				<div class="code-container">
					<input type="text" class="form-control" id="targetcode" placeholder="Target Code">
				</div>
            </div>
<?php endif; ?>
        </div>
    </nav>
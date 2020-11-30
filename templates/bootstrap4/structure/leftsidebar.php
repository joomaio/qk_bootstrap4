<!-- Header -->
<header class="header-tablet d-none d-md-block" role="banner" id="top">
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-auto col-md-3 col-xl-2 mr-0" href="<?php echo $this->baseurl; ?>"><?php echo $logo; ?></a>
        <jdoc:include type="modules" name="search" style="none" />
    </nav>
</header>
<header class="header-moblie d-md-none" role="banner">
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $this->baseurl; ?>">
                <?php echo $logo; ?>
                <?php if ($this->params->get('sitedescription')) : ?>
                    <?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <jdoc:include type="modules" name="menu" style="none" />
                <jdoc:include type="modules" name="search" style="nocontainer" />
            </div>
        </div>
    </nav>
</header>


<div class="row no-gutters">
    <nav class="col-md-3 col-xl-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <jdoc:include type="modules" name="position-10" style="none" />
        </div>
    </nav>
    <div class="content-wrapper col-md-9 ml-sm-auto col-xl-10 px-4">

        <?php if ($this->countModules('position-1')) : ?>
            <jdoc:include type="modules" name="position-1" style="none" />
        <?php endif; ?>

        <?php if ($this->countModules('position-2')) : ?>
            <jdoc:include type="modules" name="position-2" style="none" />
        <?php endif; ?>

        <main id="content" role="main" class="<?php //echo $span; ?>">
            <!-- Begin Content -->

            <?php if ($this->countModules('position-3')) : ?>
                <jdoc:include type="modules" name="position-3" style="none" />
            <?php endif; ?>

            <jdoc:include type="message" />
            <jdoc:include type="component" />
            
            <?php if ($this->countModules('position-4')) : ?>
                <jdoc:include type="modules" name="position-4" style="none" />
            <?php endif; ?>

            <!-- End Content -->
        </main>

        <?php if ($this->countModules('position-5')) : ?>
            <jdoc:include type="modules" name="position-5" style="none" />
        <?php endif; ?>

        <?php if ($this->countModules('position-6')) : ?>
            <jdoc:include type="modules" name="position-6" style="none" />
        <?php endif; ?>

    </div>
</div>
<script>
/* globals Chart:false, feather:false */

(function () {
  

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
      ],
      datasets: [{
        data: [
          15339,
          21345,
          18483,
          24003,
          23489,
          24092,
          12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
}())
</script>

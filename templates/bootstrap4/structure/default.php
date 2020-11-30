<!-- Header -->
<header class="header" role="banner" id="top">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
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
                <jdoc:include type="modules" name="search" style="none" />
            </div>
        </div>
    </nav>
</header>

<div class="content-wrapper">

    <?php if ($this->countModules('position-1')) : ?>
        <jdoc:include type="modules" name="position-1" style="container" />
    <?php endif; ?>

    <?php if ($this->countModules('position-2')) : ?>
        <jdoc:include type="modules" name="position-2" style="container" />
    <?php endif; ?>

    <main id="content" role="main" class="<?php //echo $span; ?>">
        <!-- Begin Content -->
        <div class="container">
            <jdoc:include type="message" />
        </div>

        <?php if ($this->countModules('position-3')) : ?>
            <jdoc:include type="modules" name="position-3" style="container" />
        <?php endif; ?>

        <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
            <div class="row">                
                <div class="col-12">
                    <jdoc:include type="component" />
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        <?php if ($this->countModules('position-4')) : ?>
            <jdoc:include type="modules" name="position-4" style="container" />
        <?php endif; ?>

        <!-- End Content -->
    </main>

    <?php if ($this->countModules('position-5')) : ?>
        <jdoc:include type="modules" name="position-5" style="container" />
    <?php endif; ?>

    <?php if ($this->countModules('position-6')) : ?>
        <jdoc:include type="modules" name="position-6" style="container" />
    <?php endif; ?>

</div>

<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="row">        
            <div class="col-md-3 text-center text-md-left">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></p>
            </div>
            <div class="col-md-6">
                <jdoc:include type="modules" name="footer" style="none" />
            </div>
            <div class="col-md-3 text-center text-md-right">
               <p><a href="#" id="back-top">
                    <?php echo JText::_('TPL_BOOTSTRAP4_BACKTOTOP'); ?>
                </a></p>
            </div>
        </div>
    </div>
</footer>
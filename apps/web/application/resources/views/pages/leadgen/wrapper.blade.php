@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

        <!-- Page Title & Bread Crumbs -->
        @include('misc.heading-crumbs')
        <!--Page Title & Bread Crumbs -->

    </div>
    <!--page heading-->

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <!-- LeadGen iframe -->
                    <iframe 
                        src="http://localhost:3000/jobs" 
                        width="100%" 
                        height="800px" 
                        frameborder="0"
                        style="border: none; min-height: 800px;"
                        id="leadgen-iframe"
                        title="LeadGen Interface">
                        <p>Your browser does not support iframes. Please <a href="http://localhost:3000/jobs" target="_blank">click here</a> to open LeadGen in a new window.</p>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->

<style>
/* Custom styles for LeadGen iframe */
#leadgen-iframe {
    width: 100%;
    min-height: 800px;
    border: none;
    background: #fff;
}

/* Responsive iframe */
@media (max-width: 768px) {
    #leadgen-iframe {
        min-height: 600px;
    }
}

/* Loading state */
.iframe-loading {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 400px;
    background: #f8f9fa;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const iframe = document.getElementById('leadgen-iframe');
    
    // Add loading state
    iframe.addEventListener('load', function() {
        console.log('LeadGen iframe loaded successfully');
    });
    
    // Handle iframe errors
    iframe.addEventListener('error', function() {
        console.error('Failed to load LeadGen iframe');
        iframe.style.display = 'none';
        const errorMsg = document.createElement('div');
        errorMsg.className = 'alert alert-warning text-center';
        errorMsg.innerHTML = '<strong>Unable to load LeadGen interface.</strong><br>Please ensure the LeadGen service is running on <a href="http://localhost:3000/jobs" target="_blank">http://localhost:3000/jobs</a>';
        iframe.parentNode.insertBefore(errorMsg, iframe);
    });
});
</script>

@endsection

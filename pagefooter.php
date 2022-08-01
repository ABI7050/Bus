   <!-- Footer -->
   <footer class="footer pt-0">
       <div class="row align-items-center justify-content-lg-between">
           <div class="col-lg-12">
               <div class="copyright text-center   text-muted">
                   &copy; <?=date('Y')?> <a href="<?php echo CMPYLINK; ?>" class="font-weight-bold ml-1" target="_blank"><?php echo CMPYNAME; ?></a>
               </div>
           </div>
       </div>
   </footer>
   </div>
   </div>
   <!-- Argon Scripts -->
   <!-- Core -->
   <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
   <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/js-cookie/js.cookie.js"></script>
   <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
   <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
   <!-- Optional JS -->
   <script src="assets/vendor/chart.js/dist/Chart.bundle.min.js"></script>
   <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
   <!-- Data table JS -->
   <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
   <script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
   <script src="assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
   <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
   <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
   <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
   <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
   <!-- Apex Chart JS -->
   <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
   <!-- Argon JS -->
   <script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
   <script type="text/javascript" src="./assets/js/jquery.richtext.min.js"></script>

   <script src="assets/js/argon.js?v=1.2.0"></script>
   <script>
function displayClock() {
    var display = new Date().toLocaleTimeString();
    document.getElementById('timeClock').innerHTML = display;
    setTimeout(displayClock, 1000);
}
// displayClock();
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const urlStatus = urlParams.get('status');
if (urlStatus === 'saved') {
    showNotify("<h3 class='h2'><i class='fas fa-check-circle'></i> Success! </h3>",
        "Successfully Updated",
        "success");
} else if (urlStatus === 'failed') {
    showNotify("<h3 class='h2'><i class='fas fa-exclamation-circle'></i> Error! </h3>",
        "Sorry Something wrong, Try again",
        "danger");
} else if (urlStatus === 'errorfile') {
    showNotify("<h3 class='h2'><i class='fas fa-exclamation-circle'></i> Wrong! </h3>",
        "Sorry Something wiht file upload, Try again",
        "warning");
} else if (urlStatus === 'planactivated') {
    showNotify("<h3 class='h2'><i class='fas fa-check-circle'></i> Success! </h3>",
        "New Plan Activated for customer",
        "success");
}
$(document).ready(function() {
    $('#timeClock').hide(); // Hide time clock in all pages.
    $('#datatable-buttons,.datatable-buttons').DataTable({
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        }
    });
});
   </script>
   </body>

   </html>
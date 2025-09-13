</main>
        </div>
    </div>

    <!-- Bootstrap 4 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add smooth scrolling and enhanced interactions
        $(document).ready(function() {
            // Add loading animation to buttons
            $('.btn').on('click', function() {
                if (!$(this).hasClass('no-loading')) {
                    $(this).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
                }
            });
            
            // Auto-hide alerts after 10 seconds
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 10000);
        });
    </script>
</body>
</html>
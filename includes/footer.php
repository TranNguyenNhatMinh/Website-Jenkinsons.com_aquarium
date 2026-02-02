<?php
// includes/footer.php
?>
    <!-- Footer -->
    <footer class="boardwalk-footer text-white pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row footer-row align-items-start">
                <!-- Column 1: Logo -->
                <div class="col-md-3 col-sm-6">
                    <div class="boardwalk-logo mb-3 text-center text-md-start">
                        <div class="boardwalk-logo-text mb-2">
                            <img src="img/imgfooter.ong.png" alt="Jenkinson's Boardwalk Logo" class="footer-logo-img">
                        </div>
                        <div class="footer-badge mb-1">15 YEARS</div>
                        <div class="footer-badge">BEST VALUE</div>
                    </div>
                </div>

                <!-- Column 2: Visit the Boardwalk -->
                <div class="col-md-3 col-sm-6">
                    <h6 class="mb-3 fw-bold hover-link">Visit the Boardwalk</h6>
                    <p class="small mb-1 hover-link">300 Ocean Avenue</p>
                    <p class="small mb-1 hover-link">Point Pleasant Beach, NJ 08742</p>
                    <p class="small mb-0 hover-link">732-892-0600</p>
                </div>

                <!-- Column 3: Plan Your Visit -->
                <div class="col-md-3 col-sm-6">
                    <h6 class="mb-3 fw-bold plan-visit-heading">Plan Your Visit</h6>
                    <ul class="list-unstyled small mb-0">
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none hover-link">Join Our Team</a>
                        </li>
                        <li class="mb-0">
                            <a href="#" class="text-white text-decoration-none hover-link">Adopt-An-Animal</a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Stay Connected -->
                <div class="col-md-3 col-sm-6">
                    <h6 class="mb-3 fw-bold">Stay Connected with Us for more!</h6>
                    <form class="newsletter-form d-flex flex-column gap-2" method="post" action="subscribe.php">
                        <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
                        <button type="submit" class="btn btn-subscribe fw-semibold">SUBSCRIBE</button>
                    </form>
                </div>
            </div>
            <hr class="footer-divider my-4">
            <div class="footer-bottom text-center">
                <div class="mb-2">
                    <span class="small copyright-text">&copy; <?= date('Y') ?> Jenkinson's Boardwalk. All rights reserved.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>
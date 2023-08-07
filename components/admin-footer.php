<footer class="footer">

    <style>
        img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
            display: none;
        }
        
        /*********************************** FOOTER *********************************/

.footer{
   background-color: var(--white);
   /* padding-bottom: 7rem; */
}

.footer .grid{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(27rem, 1fr));
   gap:1.5rem;
   align-items: flex-start;
}

.footer .grid .box h3{
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-transform: capitalize;
}

.footer .grid .box a{
   display: block;
   margin:1.5rem 0;
   font-size: 1.7rem;
   color:var(--light-color);
}

.footer .grid .box a i{
   padding-right: 1rem;
   color:var(--main-color);
   transition: .2s linear;
}

.footer .grid .box a:hover{
   color:var(--main-color);
}

.footer .grid .box a:hover i{
   padding-right: 2rem;
}

.footer .credit{
   text-align: center;
   padding: 2.5rem 2rem;
   border-top: var(--border);
   font-size: 2rem;
   color:var(--black);
}

.footer .credit span{
   color:var(--main-color);
}

/*********************************** FOOTER *********************************/
    </style>
   <section class="grid">

      <div class="box">
         <h3>contact us</h3>
         <a href="tel:0582350407"><i class="fas fa-phone"></i> +966 058 2350 407</a>
         <!--<a href="mailto:i5aledzeid@gmail.com"><i class="fas fa-envelope"></i> i5aledzeid@gmail.com</a>
         <a href="https://goo.gl/maps/BwSUe1HP8eXjdpVq6"><i class="fas fa-map-marker-alt"></i> Tokyo, Japan </a>-->
      </div>
      
      <div class="box">
         <h3>Email</h3>
         <a href="mailto:i5aledzeid@gmail.com"><i class="fas fa-envelope"></i> i5aledzeid@gmail.com</a>
      </div>
      
      <div class="box">
         <h3>Location</h3>
         <a href="https://goo.gl/maps/BwSUe1HP8eXjdpVq6"><i class="fas fa-map-marker-alt"></i> Tokyo, Japan </a>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-linkedin"></i>
         </a>
      </div>

   </section>

   <div style="font-size: 12px;" class="credit">&copy; copyright @ 1996-<?= date('Y'); ?> by <span>i5aledzeid</span> | all rights reserved!</div>

</footer>
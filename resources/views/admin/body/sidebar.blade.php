 <div class="vertical-menu">

     <div data-simplebar class="h-100">

         <!-- User details -->


         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title">Menu</li>

                 <li>
                     <a href="/admin/dashboard" class="waves-effect">
                         <i class="ri-dashboard-line"></i>
                         <span>Dashboard</span>
                     </a>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Suppliers</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="
                            {{ route('supplier.all') }}">All Supplier </a></li>
                         <li><a href="{{ route('supplier.add') }}">Add Supplier</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Customers</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="
                            {{ route('customer.all') }}">All Customer </a></li>
                         <li><a href="{{ route('customer.add') }}">Add Customer</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Units</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="
                            {{ route('unit.all') }}">All Unit </a></li>
                         <li><a href="{{ route('unit.add') }}">Add Unit</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Category</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="
                            {{ route('category.all') }}">All Category </a></li>
                         <li><a href="{{ route('category.add') }}">Add Category</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Products</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="
                           {{ route('product.all') }}">All Product</a></li>
                         <li><a href="{{ route('product.add') }}">Add Product</a></li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Purchase</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li>
                             <a href="{{ route('purchase.all') }}">All Purchase</a>
                         </li>
                         <li>
                             <a href="{{ route('purchase.add') }}">Add Purchase</a>
                         </li>
                     </ul>
                 </li>

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Manage Sales </span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li>
                             <a href="{{ route('invoice.all') }}">All Sales</a>
                         </li>
                         <li>
                             <a href="{{ route('invoice.add') }}">Add Sales</a>
                         </li>
                     </ul>
                 </li>
                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="ri-mail-send-line"></i>
                         <span>Stock Report </span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li>
                             <a href="{{ route('stock.report') }}">Stock Report</a>
                         </li>
                     </ul>
                 </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Report</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('daily.sales.report') }}">Daily Sales Report</a>
                        </li>
                    </ul>
                </li>
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Due Payment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('due.payment.all') }}">All Due Payment</a>
                        </li>
                        <li>
                            <a href="{{ route('due.payment.add') }}">Add Payment</a>
                        </li>
                    </ul>
                </li>

             </ul>
             {{-- <li>
                 <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="ri-layout-3-line"></i>
                     <span>Layouts</span>
                 </a>
                 <ul class="sub-menu" aria-expanded="true">
                     <li>
                         <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                             <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                             <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                             <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                             <li><a href="layouts-preloader.html">Preloader</a></li>
                             <li><a href="layouts-colored-sidebar.html">Colored Sidebar</a></li>
                         </ul>
                     </li>

                     <li>
                         <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                         <ul class="sub-menu" aria-expanded="true">
                             <li><a href="layouts-horizontal.html">Horizontal</a></li>
                             <li><a href="layouts-hori-topbar-light.html">Topbar light</a></li>
                             <li><a href="layouts-hori-boxed-width.html">Boxed width</a></li>
                             <li><a href="layouts-hori-preloader.html">Preloader</a></li>
                             <li><a href="layouts-hori-colored-header.html">Colored Header</a></li>
                         </ul>
                     </li>
                 </ul>
             </li>

             <li class="menu-title">Pages</li>

             <li>
                 <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="ri-account-circle-line"></i>
                     <span>Authentication</span>
                 </a>
                 <ul class="sub-menu" aria-expanded="false">
                     <li><a href="auth-login.html">Login</a></li>
                     <li><a href="auth-register.html">Register</a></li>
                     <li><a href="auth-recoverpw.html">Recover Password</a></li>
                     <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                 </ul>
             </li>

             <li>
                 <a href="javascript: void(0);" class="has-arrow waves-effect">
                     <i class="ri-profile-line"></i>
                     <span>Utility</span>
                 </a>
                 <ul class="sub-menu" aria-expanded="false">
                     <li><a href="pages-starter.html">Starter Page</a></li>
                     <li><a href="pages-timeline.html">Timeline</a></li>
                     <li><a href="pages-directory.html">Directory</a></li>
                     <li><a href="pages-invoice.html">Invoice</a></li>
                     <li><a href="pages-404.html">Error 404</a></li>
                     <li><a href="pages-500.html">Error 500</a></li>
                 </ul>
             </li> --}}






             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>

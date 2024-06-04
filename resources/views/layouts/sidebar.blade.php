<aside class="left-sidebar bg-light">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-center mx-auto">
      <a href="" class="text-nowrap">
        <img src="{{ asset('dist/images/logo-sjp.jpg') }}" width="50px" alt="" class="text-center d-block mx-auto"/>
        <!--<p style="text-decoration: none; color: secondary; font-weight: 600; font-size: 16pt">Logo</p>-->
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
          <?php
          $user = \Illuminate\Foundation\Auth\User::find(Auth::user()->id);
          $conn=\Illuminate\Support\Facades\DB::connection();
          $sqlMenu="SELECT m_menu_details.m_menu_group_id,
                        m_menu_groups.nama AS grup,
                        m_menu_details.m_menu_sub_id,
                        m_menu_subs.nama AS sub,
                        m_menu_details.nama AS menu,
                        m_menu_details.route_name,
                        m_menu_details.icon
                        FROM users_menus
                        INNER JOIN m_menu_details ON m_menu_details.m_menu_detail_id=users_menus.m_menu_detail_id AND m_menu_details.active=1
                        LEFT JOIN m_menu_groups ON m_menu_groups.m_menu_group_id=m_menu_details.m_menu_group_id AND m_menu_groups.active=1
                        LEFT JOIN m_menu_subs ON m_menu_subs.m_menu_sub_id=m_menu_details.m_menu_sub_id AND m_menu_subs.active=1
                        WHERE users_menus.users_id=".$user->id."
                        AND users_menus.read_=1
                        AND m_menu_details.m_menu_group_id IS NULL
                        ORDER BY m_menu_groups.nama ASC,
                        m_menu_subs.nama ASC,
                        m_menu_details.nama ASC";
          $dataMenu=$conn->select($sqlMenu);
          //echo $dataMenu;die;

          $sqlGrup="SELECT m_menu_details.m_menu_group_id,
                    m_menu_groups.nama AS grup,m_menu_groups.icon
                    FROM users_menus
                    INNER JOIN m_menu_details ON m_menu_details.m_menu_detail_id=users_menus.m_menu_detail_id AND m_menu_details.active=1 AND m_menu_details.m_menu_group_id IS NOT NULL
                    INNER JOIN m_menu_groups ON m_menu_groups.m_menu_group_id=m_menu_details.m_menu_group_id AND m_menu_groups.active=1
                    WHERE users_menus.users_id=".$user->id."
                    AND users_menus.read_=1
                    GROUP BY m_menu_details.m_menu_group_id,
                    m_menu_groups.nama,m_menu_groups.icon
                    ORDER BY m_menu_details.m_menu_group_id";
          $dataGroup=$conn->select($sqlGrup);
          //echo $sqlGrup;

          $sqlSub="SELECT m_menu_details.m_menu_group_id,
                    m_menu_groups.nama AS grup,
                    m_menu_details.m_menu_sub_id,
                    m_menu_subs.nama AS sub,
                    m_menu_subs.icon
                    FROM users_menus
                    INNER JOIN m_menu_details ON m_menu_details.m_menu_detail_id=users_menus.m_menu_detail_id AND m_menu_details.active=1 AND m_menu_details.m_menu_group_id IS NOT NULL AND m_menu_details.m_menu_sub_id IS NOT NULL
                    INNER JOIN m_menu_groups ON m_menu_groups.m_menu_group_id=m_menu_details.m_menu_group_id AND m_menu_groups.active=1
                    INNER JOIN m_menu_subs ON m_menu_subs.m_menu_sub_id=m_menu_details.m_menu_sub_id AND m_menu_subs.active=1
                    WHERE users_menus.users_id=".$user->id."
                    AND users_menus.read_=1
                    GROUP BY m_menu_subs.no_urut, m_menu_subs.nama,m_menu_details.m_menu_group_id,
                    m_menu_groups.nama,m_menu_subs.icon,
                    m_menu_details.m_menu_sub_id
                    ORDER BY m_menu_subs.no_urut, m_menu_subs.nama asc";
          $dataSub=$conn->select($sqlSub);
          //echo $sqlSub;

          $sqlMenu="SELECT m_menu_details.m_menu_group_id,
                    m_menu_groups.nama AS grup,
                    m_menu_details.m_menu_sub_id,
                    m_menu_subs.nama AS sub,
                    m_menu_details.nama AS menu,
                    m_menu_details.route_name,
                    m_menu_details.icon
                    FROM users_menus
                    INNER JOIN m_menu_details ON m_menu_details.m_menu_detail_id=users_menus.m_menu_detail_id AND m_menu_details.active=1
                    LEFT JOIN m_menu_groups ON m_menu_groups.m_menu_group_id=m_menu_details.m_menu_group_id AND m_menu_groups.active=1
                    LEFT JOIN m_menu_subs ON m_menu_subs.m_menu_sub_id=m_menu_details.m_menu_sub_id AND m_menu_subs.active=1
                    WHERE users_menus.users_id=".$user->id."
                    AND users_menus.read_=1
                    AND m_menu_details.m_menu_group_id IS NOT NULL
                    ORDER BY m_menu_details.no_urut, m_menu_groups.nama ASC,
                    m_menu_subs.nama ASC,
                    m_menu_details.nama ASC";
          $dataMenu=$conn->select($sqlMenu);
          //echo $sqlMenu;

          foreach ($dataGroup AS $dg){
          ?>
                <hr>
              <li class="nav header"> {!! $dg->grup !!}
              <li class="sidebar-item dropdown" style="padding: 0!important;">
              <?php
              $sqlMenuDetail="SELECT m_menu_details.m_menu_group_id,
                                            m_menu_groups.nama AS grup,
                                            m_menu_details.m_menu_sub_id,
                                            m_menu_details.nama AS menu,
                                            m_menu_details.route_name,
                                            m_menu_details.icon
                                            FROM users_menus
                                            INNER JOIN m_menu_details ON m_menu_details.m_menu_detail_id=users_menus.m_menu_detail_id AND m_menu_details.active=1
                                            LEFT JOIN m_menu_groups ON m_menu_groups.m_menu_group_id=m_menu_details.m_menu_group_id AND m_menu_groups.active=1
                                            WHERE users_menus.users_id=".$user->id."
                                            AND users_menus.read_=1 AND m_menu_details.m_menu_sub_id is null
                                            AND m_menu_details.m_menu_group_id=".$dg->m_menu_group_id."
                                            ORDER BY m_menu_details.no_urut,m_menu_groups.nama ASC,
                                            m_menu_details.nama ASC";
              $dataMenuDetail=$conn->select($sqlMenuDetail);
              //echo $sqlMenuDetail;

              foreach ($dataMenuDetail as $dmd){
              ?>
                  <a href="{!! $dmd->route_name !!}" class="sidebar-link dropdown-btn" style="padding: 0 0 0 15px!important; font-size: 9pt">
                      <i class=" {!! $dmd->icon !!} "></i> {!! $dmd->menu !!}
                  </a>
          <?php
          }

          foreach ($dataSub as $ds){
          if($ds->m_menu_group_id==$dg->m_menu_group_id){
          ?>
              <li class="sidebar-item dropdown" style="padding: 0!important;">
                  <a href="#" class="sidebar-link dropdown-btn" style="padding: 0 0 0 15px!important; font-size: 9pt">
                      <i class=" {!! $ds->icon !!} "></i> {!! $ds->sub !!}
                  </a>

              <?php
              $sqlMenuSub="SELECT m_menu_details.m_menu_group_id,
                                                    m_menu_groups.nama AS grup,
                                                    m_menu_details.m_menu_sub_id,
                                                    m_menu_subs.nama AS sub,
                                                    m_menu_details.nama AS menu,
                                                    m_menu_details.route_name,
                                                    m_menu_details.icon
                                                    FROM users_menus
                                                    INNER JOIN m_menu_details ON m_menu_details.m_menu_detail_id=users_menus.m_menu_detail_id AND m_menu_details.active=1
                                                    LEFT JOIN m_menu_groups ON m_menu_groups.m_menu_group_id=m_menu_details.m_menu_group_id AND m_menu_groups.active=1
                                                    LEFT JOIN m_menu_subs ON m_menu_subs.m_menu_sub_id=m_menu_details.m_menu_sub_id AND m_menu_subs.active=1
                                                    WHERE users_menus.users_id=".$user->id."
                                                    AND users_menus.read_=1 AND m_menu_details.m_menu_sub_id=".$ds->m_menu_sub_id."
                                                    AND m_menu_details.m_menu_group_id IS NOT NULL
                                                    ORDER BY m_menu_subs.no_urut asc,m_menu_details.no_urut asc,m_menu_subs.nama ASC,
                                                    m_menu_groups.nama ASC,
                                                    m_menu_details.nama ASC";
              $dataMenuSub=$conn->select($sqlMenuSub);
                //echo $sqlMenuSub;
              foreach($dataMenuSub as $dms){
                  //print_r($dms)
              ?>
                  <ul class="dropdown container" style="padding: 0!important;">
                      <li class="sidebar-item dropdown" style="padding: 0!important;">
                          <a href=" {!! $dms->route_name !!} " class="sidebar-link dropdown-btn" style="padding: 0 0 0 15px!important; font-size: 9pt">
                              <i class=" {!! $dms->icon !!} "></i> {!! $dms->menu !!}
                          </a>
                      </li>
                  </ul>
              <?php
              }
              ?>
          </li>
          <?php
          }
          }
          ?>
          </li>
          <?php
          }
          ?>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
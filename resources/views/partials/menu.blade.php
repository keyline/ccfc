<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;background-color: #000000 !important;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('billing_access')
                <li class="nav-item has-treeview {{ request()->is('admin/payments*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                        </i>
                        <p>
                            {{ trans('cruds.billing.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('payment_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.payments.index') }}"
                                class="nav-link {{ request()->is('admin/payments') || request()->is('admin/payments/*') ? 'active' : '' }}">
                                <i class="fa-fw nav-icon fas fa-money-bill">

                                </i>
                                <p>
                                    {{ trans('cruds.payment.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('content_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is('admin/event-details*') ? 'menu-open' : '' }} {{ request()->is('admin/newss*') ? 'menu-open'  : '' }} {{ request()->is('admin/reciprocal-clubs*') ? 'menu-open' : '' }} {{ request()->is('admin/sportsmen*') ? 'menu-open' : '' }} {{ request()->is('admin/past-presidents*') ? 'menu-open' : '' }} {{ request()->is('admin/trophies*') ? 'menu-open' : '' }} {{ request()->is('admin/amenities-services*') ? 'menu-open' : '' }} {{ request()->is('admin/*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-book">

                        </i>
                        <p>
                            {{ trans('cruds.contentManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!-- @can('event_detail_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.event-details.index") }}"
                                class="nav-link {{ request()->is("admin/event-details") || request()->is("admin/event-details/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-calendar-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.eventDetail.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan -->
                        <!-- @can('news_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.newss.index") }}"
                                class="nav-link {{ request()->is("admin/newss") || request()->is("admin/newss/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-newspaper">

                                </i>
                                <p>
                                    {{ trans('cruds.news.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan -->


                        @can('reciprocal_club_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.reciprocal-clubs.index") }}"
                                class="nav-link {{ request()->is("admin/reciprocal-clubs") || request()->is("admin/reciprocal-clubs/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-handshake">

                                </i>
                                <p>
                                    {{ trans('cruds.reciprocalClub.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('sportsman_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sportsmen.index") }}"
                                class="nav-link {{ request()->is("admin/sportsmen") || request()->is("admin/sportsmen/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-futbol">

                                </i>
                                <p>
                                    {{ trans('cruds.sportsman.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('past_president_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.past-presidents.index") }}"
                                class="nav-link {{ request()->is("admin/past-presidents") || request()->is("admin/past-presidents/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user-astronaut">

                                </i>
                                <p>
                                    {{ trans('cruds.pastPresident.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('trophy_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.trophies.index") }}"
                                class="nav-link {{ request()->is("admin/trophies") || request()->is("admin/trophies/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-trophy">

                                </i>
                                <p>
                                    {{ trans('cruds.trophy.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('amenities_service_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.amenities-services.index") }}"
                                class="nav-link {{ request()->is("admin/amenities-services") || request()->is("admin/amenities-services/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-swimmer">

                                </i>
                                <p>
                                    {{ trans('cruds.amenitiesService.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('static_page_management_access')
                        <li
                            class="nav-item has-treeview {{ request()->is("admin/content-categories*") ? "menu-open" : "" }} {{ request()->is("admin/content-tags*") ? "menu-open" : "" }} {{ request()->is("admin/content-pages*") ? "menu-open" : "" }} {{ request()->is("admin/content-blocks*") ? "menu-open" : "" }}">
                            <a class="nav-link nav-dropdown-toggle" href="#">
                                <i class="fa-fw nav-icon fas fa-cogs">

                                </i>
                                <p>
                                    {{ trans('cruds.staticPageManagement.title') }}
                                    <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}"
                                        class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                                @endcan
                                @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}"
                                        class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                                @endcan
                                @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}"
                                        class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                                @endcan

                                <li class="nav-item">
                                    <a href="{{ route("admin.circulars") }}" class="nav-link">
                                        <p>
                                            <i class="fa-fw nav-icon far fa-edit">

                                            </i>
                                            <p>{{ trans('global.circular') }}</p>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route("admin.event") }}" class="nav-link">
                                        <p>
                                            <i class="fa-fw nav-icon far fa-edit">

                                            </i>
                                            <p>{{ trans('global.event') }}</p>
                                        </p>
                                    </a>
                                </li>

                                @can('content_block_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-blocks.index") }}"
                                        class="nav-link {{ request()->is("admin/content-blocks") || request()->is("admin/content-blocks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-edit">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentBlock.title') }}
                                        </p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('committee_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/committee-names*") ? "menu-open" : "" }} {{ request()->is("admin/committee-member-mappings*") ? "menu-open" : "" }} {{ request()->is("admin/sub-committee-members*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-users">

                        </i>
                        <p>
                            {{ trans('cruds.committeeManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('committee_name_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.committee-names.index") }}"
                                class="nav-link {{ request()->is("admin/committee-names") || request()->is("admin/committee-names/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-file-signature">

                                </i>
                                <p>
                                    {{ trans('cruds.committeeName.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('committee_member_mapping_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.committee-member-mappings.index") }}"
                                class="nav-link {{ request()->is("admin/committee-member-mappings") || request()->is("admin/committee-member-mappings/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-users-cog">

                                </i>
                                <p>
                                    {{ trans('cruds.committeeMemberMapping.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('sub_committee_member_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sub-committee-members.index") }}"
                                class="nav-link {{ request()->is("admin/sub-committee-members") || request()->is("admin/sub-committee-members/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon far fa-handshake">

                                </i>
                                <p>
                                    {{ trans('cruds.subCommitteeMember.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('gallery_access')
                <li class="nav-item">
                    <a href="{{ route("admin.galleries.index") }}"
                        class="nav-link {{ request()->is("admin/galleries") || request()->is("admin/galleries/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-images">

                        </i>
                        <p>
                            {{ trans('cruds.gallery.title') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('contact_access')
                <li class="nav-item">
                    <a href="{{ route("admin.contact.index") }}"
                        class="nav-link {{ request()->is("admin/contact") || request()->is("admin/contact/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-images">

                        </i>
                        <p>
                            {{ trans('cruds.contact.title') }}
                        </p>
                    </a>
                </li>
                @endcan
                @can('sports_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/sportstypes*") ? "menu-open" : "" }} {{ request()->is("admin/titles*") ? "menu-open" : "" }} {{ request()->is("admin/members*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-gamepad">

                        </i>
                        <p>
                            {{ trans('cruds.sportsManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('sportstype_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sportstypes.index") }}"
                                class="nav-link {{ request()->is("admin/sportstypes") || request()->is("admin/sportstypes/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-football-ball">

                                </i>
                                <p>
                                    {{ trans('cruds.sportstype.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('title_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.titles.index") }}"
                                class="nav-link {{ request()->is("admin/titles") || request()->is("admin/titles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-id-card-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.title.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('member_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.members.index") }}"
                                class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user-check">

                                </i>
                                <p>
                                    {{ trans('cruds.member.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('user_management_access')
                <li
                    class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/user-details*") ? "menu-open" : "" }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-users">

                        </i>
                        <p>
                            {{ trans('cruds.userManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}"
                                class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-unlock-alt">

                                </i>
                                <p>
                                    {{ trans('cruds.permission.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}"
                                class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-briefcase">

                                </i>
                                <p>
                                    {{ trans('cruds.role.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}"
                                class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-user">

                                </i>
                                <p>
                                    {{ trans('cruds.user.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_detail_access')
                        <!-- <li class="nav-item">
                            <a href="{{ route("admin.user-details.index") }}"
                                class="nav-link {{ request()->is("admin/user-details") || request()->is("admin/user-details/*") ? "active" : "" }}">
                                <i class="fa-fw nav-icon fas fa-info">

                                </i>
                                <p>
                                    {{ trans('cruds.userDetail.title') }}
                                </p>
                            </a>
                        </li> -->
                        @endcan
                    </ul>
                </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                        href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key nav-icon">
                        </i>
                        <p>
                            {{ trans('global.change_password') }}
                        </p>
                    </a>
                </li>
                @endcan


                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.list-campaign') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.email') }}</p>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/contactus') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa fa-address-book">

                            </i>
                            <p>{{ trans('global.contact-us') }}</p>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/create/contactlist') }}" class="nav-link">
                        <p>
                            <i class="fa-fw nav-icon far fa-edit">

                            </i>
                            <p>Contact List</p>
                        </p>
                    </a>
                </li>
                <!-- Begin Tender Document Upload -->
                @can('tender_management_access')
                    <li
                    class="nav-item has-treeview {{ request()->is('admin/tenderuploads*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-gamepad">

                        </i>
                        <p>
                            {{ trans('cruds.tenderManagement.title') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('tenderupload_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.tenderuploads.index') }}"
                                class="nav-link {{ request()->is('admin/tenderuploads') || request()->is('admin/tenderuploads/*') ? 'active' : '' }}">
                                <i class="fa-fw nav-icon fas fa-football-ball">

                                </i>
                                <p>
                                    {{ trans('cruds.tenderupload.title') }}
                                </p>
                            </a>
                        </li>
                        @endcan
                       
                    </ul>
                </li>

                
                @endcan
                <!-- End Tender Document Upload -->

                <!-- start mobile app -->
                <li class="nav-item has-treeview {{ request()->is('admin/tenderuploads*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="javascript:void(0);">
                        <i class="fa-fw nav-icon fas fa-mobile"></i>
                        <p>
                            Mobile App
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="<?=url('admin/create/cookingcategorylist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Whats Cooking Categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('admin/create/cookingitemlist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Whats Cooking Items
                                </p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?=url('admin/create/mustreadlist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Circulars
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('admin/create/mustreadlist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Events
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('admin/create/dayspeciallist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Day Specials
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('admin/create/otherfooditemlist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Other Food Items
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('admin/create/cookingitemreportlist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Whats Cooking Reports
                                </p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?=url('admin/create/spabookingtrackinglist')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Spa Booking Trackings
                                </p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?=url('admin/create/profileupdaterequests')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Profile Update Requests
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=url('admin/create/deleteaccountrequests')?>" class="nav-link">
                                <i class="fa-fw nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Delete Account Requests
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End mobile app -->

                <li class="nav-item">
                    <a href="{{ url('admin/create/settinglist') }}" class="nav-link">
                        <p>
                            <i class="fa-fw nav-icon fa fa-cogs"></i>
                            <p>Settings</p>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
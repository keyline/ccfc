<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 29,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 30,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 31,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 32,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 33,
                'title' => 'committee_management_access',
            ],
            [
                'id'    => 34,
                'title' => 'committee_name_create',
            ],
            [
                'id'    => 35,
                'title' => 'committee_name_edit',
            ],
            [
                'id'    => 36,
                'title' => 'committee_name_show',
            ],
            [
                'id'    => 37,
                'title' => 'committee_name_delete',
            ],
            [
                'id'    => 38,
                'title' => 'committee_name_access',
            ],
            [
                'id'    => 39,
                'title' => 'committee_member_mapping_create',
            ],
            [
                'id'    => 40,
                'title' => 'committee_member_mapping_edit',
            ],
            [
                'id'    => 41,
                'title' => 'committee_member_mapping_show',
            ],
            [
                'id'    => 42,
                'title' => 'committee_member_mapping_delete',
            ],
            [
                'id'    => 43,
                'title' => 'committee_member_mapping_access',
            ],
            [
                'id'    => 44,
                'title' => 'event_detail_create',
            ],
            [
                'id'    => 45,
                'title' => 'event_detail_edit',
            ],
            [
                'id'    => 46,
                'title' => 'event_detail_show',
            ],
            [
                'id'    => 47,
                'title' => 'event_detail_delete',
            ],
            [
                'id'    => 48,
                'title' => 'event_detail_access',
            ],
            [
                'id'    => 49,
                'title' => 'news_create',
            ],
            [
                'id'    => 50,
                'title' => 'news_edit',
            ],
            [
                'id'    => 51,
                'title' => 'news_show',
            ],
            [
                'id'    => 52,
                'title' => 'news_delete',
            ],
            [
                'id'    => 53,
                'title' => 'news_access',
            ],
            [
                'id'    => 54,
                'title' => 'reciprocal_club_create',
            ],
            [
                'id'    => 55,
                'title' => 'reciprocal_club_edit',
            ],
            [
                'id'    => 56,
                'title' => 'reciprocal_club_show',
            ],
            [
                'id'    => 57,
                'title' => 'reciprocal_club_delete',
            ],
            [
                'id'    => 58,
                'title' => 'reciprocal_club_access',
            ],
            [
                'id'    => 59,
                'title' => 'sportsman_create',
            ],
            [
                'id'    => 60,
                'title' => 'sportsman_edit',
            ],
            [
                'id'    => 61,
                'title' => 'sportsman_show',
            ],
            [
                'id'    => 62,
                'title' => 'sportsman_delete',
            ],
            [
                'id'    => 63,
                'title' => 'sportsman_access',
            ],
            [
                'id'    => 64,
                'title' => 'past_president_create',
            ],
            [
                'id'    => 65,
                'title' => 'past_president_edit',
            ],
            [
                'id'    => 66,
                'title' => 'past_president_show',
            ],
            [
                'id'    => 67,
                'title' => 'past_president_delete',
            ],
            [
                'id'    => 68,
                'title' => 'past_president_access',
            ],
            [
                'id'    => 69,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}

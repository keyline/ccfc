<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserFromApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function it_updates_users_from_api()
    {

        $apiResponse = [
                    json_decode('{
    "Result": "success",
    "data": {
        "MEMBERTYPECODE": "W",
        "MEMBERTYPE": "SPECIAL MEMBER - WITHOUT ADM CHG",
        "MEMBER_CODE": "A002",
        "SALUT": "",
        "MEMBER_NAME": "UMA  AHMED",
        "DOB": "16 Jun 1931",
        "MEMBER_SINCE": "01 Jan 2000",
        "SEX": "M",
        "ADDRESS1": "3 SE3RD",
        "ADDRESS2": "FLAT - 3 SE",
        "ADDRESS3": "5, QUEENS PARK",
        "CITY": "KOLKATA",
        "STATE": "WEST-BENGAL",
        "PIN": "700 019",
        "PHONE1": "2461-4178 / 4759",
        "PHONE2": "",
        "MOBILENO": "8820855222",
        "EMAIL": "umaahmedtest@hotmail.com",
        "CURENTSTATUS": "ACTIVE",
        "REPRESENTED_CLUB_IN": "",
        "HOBBIES/ INTERESTS": "",
        "BUSINESS/ PROFESSION": "",
        "CATEGORY": "",
        "ADDRESS1": "",
        "ADDRESS2": "",
        "ADDRESS3": "",
        "CITY": "",
        "STATE": "",
        "PIN": "",
        "PHONE1": "",
        "PHONE2": "",
        "BUSINESS_EMAIL": "",
        "SPOUSE_NAME": "LATE MUMTAZ AHMED",
        "SPOUSE_DOB": "01 Jan 1900",
        "SEX": "M",
        "PHONE1": "",
        "PHONE2": "",
        "SPOUSEMOBILENO": "",
        "EMAIL": "",
        "ANNIVERSARY_DATE": "01 Jan 1900",
        "SPOUSE_BUSINESS/ PROFESSION": "",
        "CATEGORY": "",
        "ADDRESS1": "3 SE3RD",
        "ADDRESS2": "FLAT - 3 SE",
        "ADDRESS3": "5, QUEENS PARK",
        "CITY": "KOLKATA",
        "STATE": "WEST-BENGAL",
        "PIN": "700 019",
        "PHONE1": "2461-4178 / 4759",
        "PHONE2": "",
        "EMAIL": "",
        
        "SpouseImage": null,
        "children": [
            {
                "CHILDREN1_NAME": "AYESHA AHMED",
                "DOB": "01 Jan 1900",
                "SEX": "F",
                "PHONE1": "",
                "PHONE2": "",
                "MOBILENO": "",
                "Image": ""
            },
            {
                "CHILDREN1_NAME": "ANJUM AHMED",
                "DOB": "01 Jan 1900",
                "SEX": "F",
                "PHONE1": "",
                "PHONE2": "",
                "MOBILENO": "",
                "Image": ""
            },
            {
                "CHILDREN1_NAME": "ADIL AHMED AHMED",
                "DOB": "01 Jan 1900",
                "SEX": "F",
                "PHONE1": "",
                "PHONE2": "",
                "MOBILENO": "",
                "Image": ""
            }
        ]
    }
}', true),
json_decode('{
    "Result": "success",
    "data": {
        "MEMBERTYPECODE": "P ",
        "MEMBERTYPE": "PERMANENT",
        "MEMBER_CODE": "A030",
        "SALUT": "",
        "MEMBER_NAME": "XERXES DARIUS ANKLESARIA",
        "DOB": "23 Jul 1962",
        "MEMBER_SINCE": "05 Dec 1997",
        "SEX": "M",
        "ADDRESS1": "FLAT-104",
        "ADDRESS2": "WELLESLY MANSION",
        "ADDRESS3": "44/A, RAFI AHMED KIDWAI ROAD",
        "CITY": "KOLKATA",
        "STATE": "WEST-BENGAL",
        "PIN": "700 016",
        "PHONE1": "40014568",
        "PHONE2": "9874133311",
        "MOBILENO": "8777617546",
        "EMAIL": "anklesariaxerxetest@gmail.com",
        "CURENTSTATUS": "ACTIVE",
        "REPRESENTED_CLUB_IN": "",
        "HOBBIES/ INTERESTS": "",
        "BUSINESS/ PROFESSION": "",
        "CATEGORY": "",
        "ADDRESS1": "FLAT NO. 104",
        "ADDRESS2": "WELLESLY MANSION",
        "ADDRESS3": "44/A, RAFI AHMED KIDWAI ROAD",
        "CITY": "KOLKATA",
        "STATE": "WEST-BENGAL",
        "PIN": "700 016.",
        "PHONE1": "",
        "PHONE2": "",
        "BUSINESS_EMAIL": "",
        "SPOUSE_NAME": "INDRANI",
        "SPOUSE_DOB": "19 Nov 1972",
        "SEX": "M",
        "PHONE1": "",
        "PHONE2": "",
        "SPOUSEMOBILENO": "",
        "EMAIL": "",
        "ANNIVERSARY_DATE": "01 Jan 1900",
        "SPOUSE_BUSINESS/ PROFESSION": "",
        "CATEGORY": "",
        "ADDRESS1": "FLAT-104",
        "ADDRESS2": "WELLESLY MANSION",
        "ADDRESS3": "44/A, RAFI AHMED KIDWAI ROAD",
        "CITY": "KOLKATA",
        "STATE": "WEST-BENGAL",
        "PIN": "700 016",
        "PHONE1": "40014568",
        "PHONE2": "9874133311",
        "EMAIL": "",
       
        "children": [
            {
                "CHILDREN1_NAME": "VARUN ANKLESARIA",
                "DOB": "18 Jul 2001",
                "SEX": "M",
                "PHONE1": "",
                "PHONE2": "",
                "MOBILENO": "",
                
            },
            {
                "CHILDREN1_NAME": "ANISA ANKLESARIA",
                "DOB": "27 Jul 2007",
                "SEX": "F",
                "PHONE1": "",
                "PHONE2": "",
                "MOBILENO": "",
                
            }
        ]
    }
}', true)
                    // Add more sample data as needed
                ];

        // Mock the external API request
        $this->mockApiRequest($apiResponse);

        // Run the artisan command
        $this->artisan('update:users');

        // Assert that users are updated based on the API response
        $this->assertDatabaseHas('users', ['id' => 2, 'name' => 'UMA AHMED', 'email' => 'umaahmed@hotmail.com']);
        $this->assertDatabaseHas('users', ['id' => 23, 'name' => 'XERXES DARIUS ANKLESARIA', 'email' => 'anklesariaxerxes@gmail.com']);

    }

    private function mockApiRequest($response)
    {

        // Mock the HTTP client (replace with the actual method used in your command)
        $this->mock(HttpClient::class, function ($mock) use ($response) {
            $mock->shouldReceive('get')->andReturn(json_encode($response));
        });

    }
}

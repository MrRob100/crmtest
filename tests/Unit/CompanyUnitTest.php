<?php

namespace Tests\Unit;

use App\Company;
use App\Http\Controllers\CompaniesController;
use Illuminate\Http\Request;
use Tests\TestCase;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CompanyUnitTest extends TestCase
{

    use RefreshDatabase;


    public function testCompaniesDatabaseTableHasExpectedColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('companies', [
              'name',
              'email',
              'logo',
              'website'
            ]), 1);

    }

    /**
     * Tests creating a company's db record.
     *
     * @return void
     */
    public function testCreateCompanyTest()
    {
        $data = [
            'name' => 'testcompany',
            'email' => 'test@company.com',
            'logo' => 'public/storage/logos/usp.png',
            'website' => 'www.testcompany.com'
        ];

        $company = new Company;
        $company->name = $data['name'];
        $company->email = $data['email'];
        $company->logo = $data['logo'];
        $company->website = $data['website'];
        $company->save();

        //testing that data is stored
        $this->assertTrue($company->save());

        $company_fetched = $company->all()->where('name',  '=', 'testcompany');

        //testing that data is coming returned
        $this->assertNotNull($company_fetched);

        //testing that the right data is returned
        $this->assertEquals($company_fetched->first()->value('name'), $data['name']);
        $this->assertEquals($company_fetched->first()->value('email'), $data['email']);
        $this->assertEquals($company_fetched->first()->value('logo'), $data['logo']);
        $this->assertEquals($company_fetched->first()->value('website'), $data['website']);

    }

    /**
     * Tests updating a company's db record.
     *
     * @return void
     */
//    public function testUpdateCompanyTest()
//    {
//        $this->assertTrue(true);
//    }


}

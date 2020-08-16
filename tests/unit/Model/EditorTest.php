<?php

use App\Model\Editor;
use PHPUnit\Framework\TestCase;

class EditorTest extends TestCase
{
	/** @var \App\Model\Editor $editor */
	protected $editor;

	/** @before */
	public function setup(): void
	{
		$this->editor = new Editor('fname', 'lname', 'bole 04', '+251911223344', 'emp@ourmail.com');
	}

	/** @after */
	public function cleanup()
	{
		$this->editor = null;
	}

	/** @test */
	public function can_create_editor()
	{
		$this->assertEquals($this->editor->GetFirstName(), 'fname');
		$this->assertEquals($this->editor->GetLastName(), 'lname');
		$this->assertEquals($this->editor->GetAddress(), 'bole 04');
		$this->assertEquals($this->editor->GetPhonenumber(), '+251911223344');
		$this->assertEquals($this->editor->GetEmail(), 'emp@ourmail.com');
	}
	
	/** @test */
	public function can_set_first_name()
	{
		$this->editor->SetFirstName('Maya');
		$this->assertEquals($this->editor->GetFirstName(), 'Maya');
	}

	/** @test */
	public function can_set_last_name()
	{
		$this->editor->SetLastName('Girma');
		$this->assertEquals($this->editor->GetLastName(), 'Girma');
	}

	/** @test */
	public function can_set_full_name()
	{
		$this->editor->SetFullName('another', 'name');
		$this->assertEquals('another name', $this->editor->GetFullName());
	}

	/** @test */
	public function can_set_phonenumber()
	{
		$this->editor->SetPhonenumber('+251910203040');
		$this->assertEquals('+251910203040', $this->editor->GetPhonenumber());
	}

	/** @test */
	public function can_set_address()
	{
		$this->editor->SetAddress('gendegara');
		$this->assertEquals($this->editor->GetAddress(), 'gendegara');
	}

	/** @test */
	public function can_set_email()
	{
		$this->editor->SetEmail('mail@domain.com');
		$this->assertEquals($this->editor->GetEmail(), 'mail@domain.com');
	}
}
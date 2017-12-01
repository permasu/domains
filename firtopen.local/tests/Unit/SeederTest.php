public function testLinksTable()
{
  $this->seeInDatabase('links', ['title' => 'dotdev.co']);
}
<?php

/*
 * This file is part of RobotsTxt.
 *
 * (c) CyberCog <support@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Cog\RobotsTxt\RobotsTxt;

/**
 * Class RobotsTxtTest.
 */
class RobotsTxtTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_have_new_empty_instance()
    {
        $robotsTxt = new RobotsTxt();
        $this->assertEquals('', $robotsTxt->generate());
    }

    /** @test */
    public function it_can_have_sitemap()
    {
        $robotsTxt = new RobotsTxt();
        $sitemap = 'sitemap.xml';

        $this->assertNotContains($sitemap, $robotsTxt->generate());
        $robotsTxt->addSitemap($sitemap);
        $this->assertContains("Sitemap: {$sitemap}", $robotsTxt->generate());
    }

    /** @test */
    public function it_can_add_user_agent()
    {
        $robotsTxt = new RobotsTxt();
        $userAgent = 'Google';

        $this->assertNotContains("User-agent: {$userAgent}", $robotsTxt->generate());
        $robotsTxt->addUserAgent($userAgent);
        $this->assertContains("User-agent: {$userAgent}", $robotsTxt->generate());
    }

    /** @test */
    public function it_can_add_host()
    {
        $robotsTxt = new RobotsTxt();
        $host = 'www.google.com.au';

        $this->assertNotContains("Host: {$host}", $robotsTxt->generate());
        $robotsTxt->addHost($host);
        $this->assertContains("Host: {$host}", $robotsTxt->generate());
    }

    /** @test */
    public function it_can_add_disallow()
    {
        $robotsTxt = new RobotsTxt();
        $path = '/dir/';
        $paths = ['/dir-1/', '/dir-2/', '/dir-3/'];

        // Test a single path.
        $this->assertNotContains("Disallow: {$path}", $robotsTxt->generate());
        $robotsTxt->addDisallow($path);
        $this->assertContains("Disallow: {$path}", $robotsTxt->generate());

        // Test array of paths.
        foreach ($paths as $path_test) {
            $this->assertNotContains("Disallow: {$path_test}", $robotsTxt->generate());
        }

        // Add the array of paths
        $robotsTxt->addDisallow($paths);

        // Check the old path is still there
        $this->assertContains("Disallow: {$path}", $robotsTxt->generate());
        foreach ($paths as $path_test) {
            $this->assertContains("Disallow: {$path_test}", $robotsTxt->generate());
        }
    }

    /** @test */
    public function it_can_add_allow()
    {
        $robotsTxt = new RobotsTxt();
        $path = '/dir/';
        $paths = ['/dir-1/', '/dir-2/', '/dir-3/'];

        // Test a single path.
        $this->assertNotContains("Allow: {$path}", $robotsTxt->generate());
        $robotsTxt->addAllow($path);
        $this->assertContains("Allow: {$path}", $robotsTxt->generate());

        // Test array of paths.
        foreach ($paths as $path_test) {
            $this->assertNotContains("Allow: {$path_test}", $robotsTxt->generate());
        }

        // Add the array of paths
        $robotsTxt->addAllow($paths);

        // Check the old path is still there
        $this->assertContains("Allow: {$path}", $robotsTxt->generate());

        foreach ($paths as $path_test) {
            $this->assertContains("Allow: {$path_test}", $robotsTxt->generate());
        }
    }

    /** @test */
    public function it_can_add_comment()
    {
        $robotsTxt = new RobotsTxt();
        $comment_1 = 'Test comment';
        $comment_2 = 'Another comment';
        $comment_3 = 'Final test comment';

        $this->assertNotContains("# {$comment_1}", $robotsTxt->generate());
        $this->assertNotContains("# {$comment_2}", $robotsTxt->generate());
        $this->assertNotContains("# {$comment_3}", $robotsTxt->generate());

        $robotsTxt->addComment($comment_1);
        $this->assertContains("# {$comment_1}", $robotsTxt->generate());

        $robotsTxt->addComment($comment_2);
        $this->assertContains("# {$comment_1}", $robotsTxt->generate());
        $this->assertContains("# {$comment_2}", $robotsTxt->generate());

        $robotsTxt->addComment($comment_3);
        $this->assertContains("# {$comment_1}", $robotsTxt->generate());
        $this->assertContains("# {$comment_2}", $robotsTxt->generate());
        $this->assertContains("# {$comment_3}", $robotsTxt->generate());
    }

    /** @test */
    public function it_can_add_spacer()
    {
        $robotsTxt = new RobotsTxt();

        $lines = count(preg_split('/' . PHP_EOL . '/', $robotsTxt->generate()));
        $this->assertEquals(1, $lines); // Starts off with at least one line.

        $robotsTxt->addSpacer();
        $robotsTxt->addSpacer();
        $lines = count(preg_split('/' . PHP_EOL . '/', $robotsTxt->generate()));

        $this->assertEquals(2, $lines);
    }

    /** @test */
    public function it_can_reset_content()
    {
        $robotsTxt = new RobotsTxt();

        $this->assertEquals('', $robotsTxt->generate());

        $robotsTxt->addComment('First Comment');
        $robotsTxt->addHost('www.google.com');
        $robotsTxt->addSitemap('sitemap.xml');
        $this->assertNotEquals('', $robotsTxt->generate());

        $robotsTxt->reset();
        $this->assertEquals('', $robotsTxt->generate());
    }
}

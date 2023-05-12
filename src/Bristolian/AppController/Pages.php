<?php

declare(strict_types = 1);

namespace Bristolian\AppController;

use Bristolian\SiteHtml\PageStubResponseGenerator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Bristolian\MarkdownRenderer\MarkdownRenderer;

use Bristolian\Page;

class Pages
{
    public function index()
    {
        $content = "<h1>Absolute alpha</h1>";

        $content .= "<p>There is really very little here...</p>";

        $content .= "<p>At some point, there will be more.</p>";

        $content .= "<p>Maybe have a look at the <a href='/bcc/committee_meetings'>BCC committee meetings</a> about committees.</p>";
        $content .= "<p>Or why you should object to the <a href='/complaints/triangle_road'>Triangle road change</a>.</p>";

        $content .= "<p>Testing deployer...</p>";

        return $content;
    }


    public function bcc_committee_meetings()
    {
        $content = "<h1>BCC committee meetings</h1>";

        $content .= <<< HTML

<p>
  <a href="https://youtu.be/NwrqyODcHYw">Committee Model Working Group - Friday, 31st March</a>
</p>
    
<p>
  <a href="https://youtu.be/4UGLT_npxrE">Committee Model Working Group 28th April - part 1</a>
</p>

<p>
  <a href="https://youtu.be/qMwYwj-aPoU">Committee Model Working Group 28th April - part 2</a>
</p>

HTML;

        return $content;
    }


    public function floating_point_page()
    {
        $content = "<h1>Floating point shenanigans</h1>";

        $content .= "<div class='floating_point_panel'></div>";

        return $content;
    }

    public function timeline_page()
    {
        $content = "<h1>Time line page goes here</h1>";

        $content .= "<div class='time_line_panel'></div>";

        return $content;
    }

    public function teleprompter_page()
    {
        $content = "<h1>Teleprompter</h1>";
        $content .= "<p>This probably isn't working currently.</p>";
        $content .= "<div class='teleprompter_panel'></div>";

        return $content;
    }

    public function email_link_generator_page()
    {
        $content = "<h1>Email link generator</h1>";
        $content .= "Email links can be setup to include pre-filled subject, CC, BCC and body text. This is a tool that does the needful to generate appropriate HTML, for embedding in other pages.";

        $content .= "<div class='email_link_generator_panel'></div>";
        $content .= "<hr/><p></p><a href='https://mailtolink.me/'/>Or use this one</a>.</p>";

        return $content;
    }

    public function qr_code_generator_page()
    {
        $content = "<h1>QR code generator</h1>";

        $content .= "<div class='qr_code_generator_panel'></div>";
        $content .= "<p>Or just use <a href='https://smiley.codes/qrcode/'>smiley.codes/qrcode/</a></p>";

        return $content;
    }

    public function tools_page()
    {
        $content = "<h1>Tools page</h1>";
        $content .= <<< HTML
<ul>
  <li><a href="/tools/email_link_generator">Email link generator</a></li>
  <li><a href="/tools/twitter_splitter">Twitter splitter</a></li>          
  <!-- <li><a href="/tools/teleprompter">Teleprompter</a></li> -->
  <!-- <li><a href="/tools/timeline">Timeline</a></li> -->          
  <!-- <li><a href="/tools/notes">Notes</a></li> -->
  <li><a href="/tools/qr_code_generator">QR generator</a></li>
  <li><a href="/tools/floating_point">Floating point visualiser</a></li>
</ul>

HTML;

        return $content;
    }


    public function notes_page()
    {
        $content = "<h1>Note page goes here</h1>";

        $content .= "<div class='notes_panel'></div>";

        return $content;
    }

    public function twitter_splitter_page()
    {
        $content = "<h1>Twitter splitter</h1>";


        $content .= "<div class='twitter_splitter_panel'></div>";


        return $content;
    }

    public function homepage()
    {
        return "Hello there";
    }

    public function get404Page(
        Request $request,
        PageStubResponseGenerator $pageStubResponseGenerator
    ) {
        $path = $request->getUri()->getPath();

        return $pageStubResponseGenerator->create404Page($path);
    }

    public function about(MarkdownRenderer $markdownRenderer)
    {
        $fullPath = __DIR__ . "/../../../docs/site/about_page.md";
        return $markdownRenderer->renderFile($fullPath);
    }

    public function triangle_road(MarkdownRenderer $markdownRenderer)
    {
        $fullPath = __DIR__ . "/../../../docs/complaints/triangle_road.md";

        Page::setQrShareMessage("Please share this with anyone you know who would be affected by this road reopening. Show this QR code to someone, and they can scan it with the camera in their device. Or just copy pasta the URL to your socials.");

        $html = $markdownRenderer->renderFile($fullPath);
        $html .= "<hr/>";
        $html .= share_this_page();

        return $html;
    }
}

<?php
header("Content-Type: application/xml; charset=utf-8");
$aQuests = \DATABASE\FFDatabase::cfun()->select("quests")->run()->getAll();
?>

<urlset <?php echo 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'; ?> xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 ">

    <?php foreach ($aQuests as $item) { ?>

        <url>
            <loc><?php echo configs_host_ssl; ?>://www.<?php echo configs_host_domain; ?>/quest/<?php echo $item["id"]; ?></loc>
            <lastmod><?php echo explode(" ", $item["updated_at"])[0]; ?></lastmod>
        </url>

    <?php } ?>

</urlset>


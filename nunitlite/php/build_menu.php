<?php

class Menu
{
    var $items = array();

    function Add()
    {
        $items = func_get_args();
        foreach( $items as $item )
        {
          array_push( $this->items, $item );
        }
    }

    function RefersTo( $name )
    {
         foreach( $this->items as $item )
             if ( $item->RefersTo( $name ) )
                 return true;

         return false;
    }

    function Draw( $pageName, $release="" )
    {
        echo "<ul>\n";
        foreach( $this->items as $item )
          $item->Draw( $pageName, $release );
        echo "</ul>\n";
    }
}

class MenuItem
{
    var $name;
    var $display_name;
    var $subMenu;

    function MenuItem( $name, $display_name="", $subMenu=NULL )
    {
        $this->name = $name; 
        $this->display_name = $display_name;
        if ( $display_name == "" )
            $this->display_name = format_page_name( $name );
        $this->subMenu = $subMenu;
    }

    function Add()
    {
        if ( $this->subMenu == NULL )
            $this->subMenu = new Menu();
        $this->subMenu->Add( func_get_args() );
    }
    function RefersTo($name )
    {
        if ( $this->name == $name )
            return true;

        if ( $this->subMenu == NULL )
            return false;

        return $this->subMenu->RefersTo( $name );
    }

    function Draw( $pageName, $release="" )
    {	
        $link = "index.php?p=$this->name";
        if ( $release != "" )
            $link .=  "&r=$release";

        if ( $this->name == $pageName )
            echo "<li id=\"current\"><a href=\"$link\">$this->display_name</a></li>\n";
        else
            echo "<li><a href=\"$link\">$this->display_name</a></li>\n";
    
        if ( $this->subMenu != NULL && $this->RefersTo( $pageName ) )
            $this->subMenu->Draw( $pageName, $release );
    }
}

function BuildMenu( $fileName )
{
    $lines = array();
	$levels = array();

    $file = fopen( $fileName, 'r' );
    while( $line = fgets( $file ) )
    if ( $line[0] != '#' )
    {
        for( $lev = 0; $line[$lev] == ' '; $lev++ );

        array_push( $lines, trim( $line ) );
        array_push( $levels, $lev ); 
    }
	
	return BuildSubMenu( $lines, $levels, 0 );
}

function BuildSubMenu( $lines, $levels, $start )
{
    $level = $levels[$start];
    $menu = new Menu();

    for( $index = $start; $index < count( $lines); $index++ )
    {
        $lev = $levels[$index];
        if ( $lev < $level )
            break;
        elseif( $lev == $level )
            $menu->Add( BuildMenuItem( $lines, $levels, $index ) );
    }

    return $menu;
}

function BuildMenuItem( $lines, $levels, $index )
{
    $line = $lines[$index];
    $level = $levels[$index];
    $part = split( ',', $line );

    $name = $part[0];
    $display_name = "";
    if ( count( $part ) > 1 )
        $display_name = $part[1];

    $subMenu = NULL;
    $next = $index + 1;
    if ( $next < count( $lines ) && $levels[$next] > $level )
        $subMenu = BuildSubMenu( $lines, $levels, $next );

    return new MenuItem( $name, $display_name, $subMenu );
}

function DrawMenu( $menuFileName )
{
   if ( file_exists( currentPageDirectory() . $menuFileName ) )
      $menu = BuildMenu( currentPageDirectory() . $menuFileName );
   else
      $menu = BuildMenu( $menuFileName );
   $menu->Draw( currentPageName(), nunitRelease() );
}

?>
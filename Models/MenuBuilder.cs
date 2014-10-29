using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Web;

namespace nunit.org.Models
{
    public class Menu
    {
        IList<MenuItem> _items = new List<MenuItem>();

        public void Add(MenuItem item)
        {
            _items.Add(item);
        }

        public bool RefersTo(string name)
        {
            return _items.Any(item => item.RefersTo(name));
        }

        public string GetMenuString(string pageName, string release)
        {
            var builder = new StringBuilder();
            builder.AppendLine("<ul class=\"nav\">");
            foreach (var item in _items)
            {
                builder.AppendLine(item.GetMenuString(pageName, release));
            }
            builder.AppendLine("</ul>");
            return builder.ToString();
        }
    }

    public class MenuItem
    {
        public int Level { get; set; }
        public string Name { get; set; }
        public string DisplayName { get; set; }
        public Menu SubMenu { get; set; }

        public MenuItem(int level, string name, string displayName, Menu subMenu = null)
        {
            Level = level;
            Name = name;
            DisplayName = string.IsNullOrWhiteSpace(displayName) ? UppercaseFirst(name) : displayName;
            SubMenu = subMenu;
        }

        public void Add(MenuItem item)
        {
            if(SubMenu == null)
                SubMenu = new Menu();
            SubMenu.Add(item);
        }

        public bool RefersTo(string name)
        {
            if (Name == name)
                return true;

            if (SubMenu == null)
                return false;

            return SubMenu.RefersTo(name);
        }

        public string GetMenuString(string pageName, string release)
        {
            string cl = Name == pageName ? "active" : "inactive";
            var builder = new StringBuilder();
            builder.AppendFormat("<li class=\"{0}\"><a href=\"/Documentation?p={1}&r={2}\">{3}</a>", cl, Name, release, DisplayName);

            if (SubMenu != null && (RefersTo(pageName) || Level == 0))
                builder.AppendLine(SubMenu.GetMenuString(pageName, release));

            return builder.ToString();
        }

        private static string UppercaseFirst(string s)
        {
            // Check for empty string.
            if (string.IsNullOrEmpty(s))
            {
                return string.Empty;
            }
            // Return char and concat substring.
            return char.ToUpper(s[0]) + s.Substring(1);
        }
    }

    public class MenuBuilder
    {
        private readonly HttpServerUtilityBase _server;
        public MenuBuilder(HttpServerUtilityBase server)
        {
            _server = server;
        }

        public string GetMenuString(string pageName, string release)
        {
            Menu menu = BuildMenu(release);
            return menu.GetMenuString(pageName, release);
        }

        private Menu BuildMenu(string release)
        {
            var lines = GetMenuLines(release);
            var levels = (from line in lines select CountIndent(line)).ToList();

            return BuildSubMenu(lines, levels, 0);
        }

        private Menu BuildSubMenu(IList<string> lines, IList<int> levels, int start)
        {
            int level = levels[start];
            var menu = new Menu();
            for (int i = start; i < lines.Count; i++)
            {
                int lev = levels[i];
                if( lev < level )
                    break;
                if( lev == level)
                    menu.Add(BuildMenuItem(lines, levels, i));
            }
            return menu;
        }

        private MenuItem BuildMenuItem(IList<string> lines, IList<int> levels, int i)
        {
            string line = lines[i];
            int level = levels[i];
            string[] part = line.Split(',');
            string name = part[0].Trim();
            string display = part.Length > 1 ? part[1] : "";
            Menu subMenu = null;
            int next = i + 1;
            if (next < lines.Count && levels[next] > level)
                subMenu = BuildSubMenu(lines, levels, next);

            return new MenuItem(level, name, display, subMenu);
        }

        private IList<string> GetMenuLines(string release)
        {
            string filename = string.Format(@"~/docs/{0}/sub_menu.txt", release);
            var lines = new List<string>();
            try
            {
                using (var reader = new StreamReader(_server.MapPath(filename)))
                {
                    string line = reader.ReadLine();
                    while (line != null)
                    {
                        if(!line.TrimStart(null).StartsWith("#") && line.Trim().Length != 0)
                            lines.Add(line);
                        line = reader.ReadLine();
                    }
                }
            }
            catch (Exception ex)
            {
            }
            return lines;
        }

        private int CountIndent(string line)
        {
            return line.TakeWhile(c => c == ' ').Count();
        }
    }
}
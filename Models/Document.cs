using System.Collections;
using System.Collections.Generic;

namespace nunit.org.Models
{
    public class MenuItem
    {
        public MenuItem(string name, string link)
        {
            Name = name;
            Link = link;
            MenuItems = new List<MenuItem>();
        }

        public string Name { get; set; }
        public string Link { get; set; }
        public bool Selected { get; set; }

        public IList<MenuItem> MenuItems { get; set; }
    }

    public class Document
    {
        public Document(string content)
        {
            Content = content;
            MenuItems = new List<MenuItem>();
        }

        public string Content { get; set; }
        public IList<MenuItem> MenuItems { get; set; }
    }
}
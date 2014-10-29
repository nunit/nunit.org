using System.Collections;
using System.Collections.Generic;

namespace nunit.org.Models
{
    public class Document
    {
        public Document(string content, string menu)
        {
            Content = content;
            Menu = menu;
        }

        public string Content { get; set; }
        public string Menu { get; set; }
    }
}
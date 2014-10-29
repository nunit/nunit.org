using System.Collections;
using System.Collections.Generic;

namespace nunit.org.Models
{
    public class MenuItem
    {
        public MenuItem(string text, string release)
        {
            Release = release;
            string[] pair = text.Split(',');
            if (pair.Length == 2)
            {
                Name = pair[1];
                Link = pair[0];
            }
            else if (pair.Length == 1)
            {
                Link = pair[0];
                Name = UppercaseFirst(Link);
            }
        }

        public string Release { get; set; }
        public string Name { get; set; }
        public string Link { get; set; }
        public bool Selected { get; set; }

        /// <summary>
        /// Returns a string that represents the current object.
        /// </summary>
        /// <returns>
        /// A string that represents the current object.
        /// </returns>
        public override string ToString()
        {
            return string.Format("<li><a href=\"/Documentation?p={0}&r={1}\">{2}</a>", Link, Release, Name);
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
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
        private readonly HttpServerUtilityBase _server;
        public Menu(HttpServerUtilityBase server)
        {
            _server = server;
        }

        public string GetMenu( string release )
        {
            var builder = new StringBuilder();
            var lines = GetMenuLines(release);
            int lastIndent = -1;
            builder.AppendLine("<ul class=\"nav docs-sidenav\">");
            foreach (var line in lines)
            {
                var menu = new MenuItem(line.Trim(), release);
                int currentIndent = CountIndent(line);
                if (currentIndent == lastIndent)
                {
                    builder.AppendLine(menu.ToString());
                }
                else if (currentIndent > lastIndent)
                {
                    builder.AppendLine("<ul class=\"nav\">");
                    builder.AppendLine(menu.ToString());
                    lastIndent = currentIndent;
                }
                else
                {
                    builder.AppendLine(menu.ToString());
                    builder.AppendLine("</ul>");
                    lastIndent = currentIndent;
                }
            }
            builder.AppendLine("</ul>");
            return builder.ToString();
        }
        
        private IEnumerable<string> GetMenuLines(string release)
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
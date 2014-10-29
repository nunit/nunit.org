using System;
using System.IO;
using System.Linq;
using System.Text.RegularExpressions;
using System.Web;

namespace nunit.org.Models
{
    public class Documentation
    {
        private readonly HttpServerUtilityBase _server;
        public Documentation(HttpServerUtilityBase server)
        {
            _server = server;
        }

        public Document GetDocument( string page, string release )
        {
            string content = ParseOldPhpFunctions(GetDocumentationContent(page, release), release);
            var menu = new MenuBuilder(_server);
            return new Document(content, menu.GetMenuString(page, release));
        }

        private string GetDocumentationContent(string page, string release)
        {
            string content = GetFile(page, release);
            if(content.StartsWith("unchangedSince"))
            {
                // Extract the release out of unchangedSince("2.5")
                string[] parts = content.Split('"');
                if(parts.Length == 3)
                {
                    return GetDocumentationContent(page, parts[1]);
                }
            }
            return content;
        }

        private string GetFile(string page, string release)
        {
            return GetFile(string.Format(@"~/docs/{0}/{1}.html", release, page));
        }

        private string GetFile(string filename)
        {
            try
            {
                using(var reader = new StreamReader(_server.MapPath(filename)))
                {
                    return reader.ReadToEnd();
                }
            }
            catch(Exception ex)
            {
                return ex.Message;
            }
        }

        private static readonly Regex _nunitRelease = new Regex(@"nunitRelease\(\s*\)", RegexOptions.Compiled);
        private static readonly Regex _nunit_doc_link2 = new Regex("nunit_doc_link\\(\\s*\"(?<page>[^\"]+)\",\\s*\"(?<name>[^\"]+)\"\\s*\\)", RegexOptions.Compiled);
        private static readonly Regex _nunit_doc_link4 = new Regex("nunit_doc_link\\(\\s*\"(?<page>[^\"]+)\",\\s*\"(?<name>[^\"]+)\",\\s*\"[^\"]*\",\\s*\"(?<release>[^\"]*)\"\\s*\\)", RegexOptions.Compiled);
        private static readonly Regex _nunit_doc_img = new Regex("nunit_doc_img\\(\\s*\"(?<img>[^\"]+)\"\\s*\\)", RegexOptions.Compiled);
        private static readonly Regex _nunit_doc_file = new Regex("nunit_doc_file\\(\\s*\"(?<file>[^\"]+)\",\\s*\"(?<name>[^\"]+)\"\\s*\\)", RegexOptions.Compiled);

        private string ParseOldPhpFunctions(string content, string release)
        {
            // include "docs/2.6.2/releaseDetail.html";
            // nunitRelease()
            content = _nunitRelease.Replace(content, release);
            // nunit_doc_link( "releaseNotes", "here", "", "2.2.10" )
            content = _nunit_doc_link4.Replace(content, "<a href=\"/Documentation?p=${page}&r=${release}\">${name}</a>");
            // nunit_doc_link( "multiAssembly", "Multiple Assemblies" )
            content = _nunit_doc_link2.Replace(content, "<a href=\"/Documentation?p=${page}&r=" + release + "\">${name}</a>");
            // nunit_doc_img( "configEditor.jpg" )
            content = _nunit_doc_img.Replace(content, "<img src=\"/docs/" + release + "/img/${img}\" />");
            // nunit_doc_file( "TestResult.xml", "here" )
            content = _nunit_doc_file.Replace(content, "<a href=\"/docs/" + release + "/files/${file}\">${name}</a>");
            return SubstituteIncludes(content, release);
        }

        private static readonly Regex _nunitInclude = new Regex("include\\s\"(?<file>docs/[\\d.]+/\\w+\\.\\w+)\";", RegexOptions.Compiled);

        private string SubstituteIncludes(string content, string release)
        {
            MatchCollection matches = _nunitInclude.Matches(content);
            var replace = (from Match match in matches
                           select new Tuple<string, string>(match.Value, match.Groups["file"].Value)).ToList();
            foreach(var tuple in replace)
            {
                var include = ParseOldPhpFunctions(GetFile(string.Format(@"~/{0}", tuple.Item2)), release);
                content = content.Replace(tuple.Item1, include);
            }
            return content;
        }
    }
}
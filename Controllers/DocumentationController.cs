using System.Web.Mvc;
using nunit.org.Models;

namespace nunit.org.Controllers
{
    public class DocumentationController : Controller
    {
        // GET: Documentation?p={page}&r={release}
        public ActionResult Index(string p = null, string r = null)
        {
            if(p == null || r == null)
                return View();

            var documentation = new Documentation( Server );
            ViewBag.Title = string.Format("{0} Documentation", r);
            var document = documentation.GetDocument(p, r);

            return View("Documentation", document);
        }
    }
}
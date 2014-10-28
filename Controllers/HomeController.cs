using System.Web.Mvc;

namespace nunit.org.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            return View();
        }
        
        public ActionResult Download()
        {
            return View();
        }

        public ActionResult Donations()
        {
            return View();
        }

        public ActionResult Contact()
        {
            return View();
        }
    }
}
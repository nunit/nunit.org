using System.Collections.Generic;
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

        public IList<MenuItem> GetMenu( string release )
        {
            return null;
        }
    }
}
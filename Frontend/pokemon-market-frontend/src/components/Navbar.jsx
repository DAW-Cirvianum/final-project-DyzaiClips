import { Link, useNavigate } from 'react-router-dom'

function Navbar() {
    const navigate = useNavigate()
    const role = localStorage.getItem('role')

    const logout = () => {
        localStorage.removeItem('token')
        localStorage.removeItem('role')
        navigate('/login')
        window.location.reload()
    }

    return (
        <nav className="navbar">
            <h2 className="navbar-logo">Pokemon Market</h2>

            <div className="navbar-links">
                <Link to="/products">Products</Link>
                <Link to="/my-transactions">My purchases</Link>

                {/* ADMIN ONLY */}
                {role === 'admin' && (
                    <a
                        href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=pokemon_market"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Admin Panel
                    </a>
                )}

                <button className="logout-btn" onClick={logout}>
                    Logout
                </button>
            </div>
        </nav>
    )
}

export default Navbar


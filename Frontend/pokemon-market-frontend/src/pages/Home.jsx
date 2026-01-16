import { useNavigate } from 'react-router-dom'

function Home() {
    const navigate = useNavigate()

    return (
        <div className="home-container">
            <h1>Pokémon Market</h1>
            <p>Buy and sell Pokémon cards, packs and boxes.</p>

            <div className="home-actions">
                <button onClick={() => navigate('/login')}>Login</button>
                <button onClick={() => navigate('/register')}>Register</button>
            </div>
        </div>
    )
}

export default Home

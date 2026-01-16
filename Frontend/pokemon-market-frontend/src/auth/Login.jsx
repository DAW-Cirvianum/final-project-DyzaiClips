import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function Login({ setToken }) {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [error, setError] = useState('')
    const navigate = useNavigate()

    /**
     * Handle login form submission.
     * Sends credentials to the backend and stores the returned token.
     */
    const handleSubmit = async (e) => {
        e.preventDefault()
        setError('')

        try {
            const response = await api.post('/login', {
                email,
                password,
            })

            // DEBUG (pots deixar-ho o treure-ho després)
            console.log('Login response:', response.data)

            /**
             * IMPORTANT:
             * Laravel returns the token as "token"
             */
            const token = response.data.token
            const role = response.data.role

            if (!token || !role) {
                throw new Error('Token or role not found in response')
            }

            // Store token and role in localStorage
            localStorage.setItem('token', token)
            localStorage.setItem('role', role)

            setToken(token)


            // Redirect to products page
            navigate('/products')
        } catch (err) {
            console.error(err)
            setError('Invalid credentials')
        }
    }

    return (
        <div className="auth-container">
            <h2>Login</h2>

            {error && <p className="error">{error}</p>}

            <form onSubmit={handleSubmit} className="auth-form">
                <input
                    type="email"
                    placeholder="Email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    required
                />

                <input
                    type="password"
                    placeholder="Password"
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    required
                />

                <button type="submit">Login</button>
            </form>

            <p>
                Don’t have an account? <a href="/register">Register</a>
            </p>
        </div>
    )

}

export default Login


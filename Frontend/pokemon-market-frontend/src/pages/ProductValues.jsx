import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import api from '../api/axios'

const DEFAULT_IMAGE = 'https://via.placeholder.com/150?text=Product'

function ProductValues() {
    const { id } = useParams()
    const [values, setValues] = useState([])
    const [message, setMessage] = useState('')

    useEffect(() => {
        api.get(`/product-values?product_id=${id}`)
            .then(res => setValues(res.data))
            .catch(() => setMessage('Error loading product prices'))
    }, [id])

    /**
     * Buy a product value
     */
    const buy = async (productValueId) => {
        try {
            await api.post('/transactions', {
                product_value_id: productValueId
            })

            setMessage('Purchase completed successfully')

            // Update stock visually
            setValues(values.map(v =>
                v.id === productValueId
                    ? { ...v, stock: v.stock - 1 }
                    : v
            ))

        } catch (error) {
            setMessage(error.response?.data?.message || 'Error while purchasing')
        }
    }

    return (
        <div className="page-container">
            <h2>Available prices</h2>

            {message && <p className="info-message">{message}</p>}

            <div className="price-list">
                {values.map(v => (
                    <div key={v.id} className="price-card">
                        <img
                            src={v.product.image_url || DEFAULT_IMAGE}
                            alt={v.product.name}
                            style={{
                                width: '250px',
                                height: '250px',
                                objectFit: 'contain',
                                borderRadius: '8px',
                            }}
                        />
                        <h4>{v.product.name}</h4>

                        <p><strong>Condition:</strong> {v.condition}</p>
                        <p><strong>Price:</strong> €{v.price}</p>
                        <p><strong>Stock:</strong> {v.stock}</p>

                        <button
                            className="product-btn"
                            disabled={v.stock < 1}
                            onClick={() => buy(v.id)}
                        >
                            {v.stock < 1 ? 'Out of stock' : 'Buy'}
                        </button>
                    </div>
                ))}
            </div>
        </div>
    )
}

export default ProductValues


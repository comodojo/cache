<?php namespace Comodojo\Cache\Providers;

use \Comodojo\Foundation\Logging\Manager as LogManager;
use \Psr\Cache\CacheItemPoolInterface;
use \Psr\Cache\CacheItemInterface;
use \Psr\Log\LoggerInterface;
use \Comodojo\Exception\CacheException;

/**
 * @package     Comodojo Cache
 * @author      Marco Giovinazzi <marco.giovinazzi@comodojo.org>
 * @license     MIT
 *
 * LICENSE:
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

abstract class AbstractProvider implements CacheItemPoolInterface {

    /**
     * Current logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Class constructor
     *
     * @throws \Comodojo\Exception\CacheException
     */
    public function __construct(LoggerInterface $logger = null) {

        $this->setLogger($logger);

    }

    /**
     * {@inheritdoc}
     */
    public function getLogger() {

        return $this->logger;

    }

    /**
     * {@inheritdoc}
     */
    public function setLogger(LoggerInterface $logger = null) {

        $this->logger = is_null($logger) ? LogManager::create('cache', false)->getLogger() : $logger;

        return $this;

    }

    /**
     * {@inheritdoc}
     */
    abstract public function getItem($key);

    /**
     * {@inheritdoc}
     */
    abstract public function getItems(array $keys = array());

    /**
     * {@inheritdoc}
     */
    abstract public function hasItem($key);

    /**
     * {@inheritdoc}
     */
    abstract public function clear();

    /**
     * {@inheritdoc}
     */
    abstract public function deleteItem($key);

    /**
     * {@inheritdoc}
     */
    abstract public function deleteItems(array $keys);

    /**
     * {@inheritdoc}
     */
    abstract public function save(CacheItemInterface $item);

    /**
     * {@inheritdoc}
     */
    abstract public function saveDeferred(CacheItemInterface $item);

    /**
     * {@inheritdoc}
     */
    abstract public function commit();

}

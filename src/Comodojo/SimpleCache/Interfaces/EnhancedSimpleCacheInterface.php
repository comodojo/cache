<?php namespace Comodojo\SimpleCache\Interfaces;

use \Psr\SimpleCache\CacheInterface;

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

interface EnhancedSimpleCacheInterface extends CacheInterface {

    const CACHE_SUCCESS = 0;

    const CACHE_ERROR = 1;

    /**
     * Returns the internal pool's id
     *
     * @return string
     */
    public function getId();

    /**
     * Returns the current state
     *
     * @return int
     *   0 if no error.
     */
    public function getState();

    /**
     * Returns the current state
     *
     * @return string|null
     *   Last error message (if any).
     */
    public function getStateMessage();

    /**
     * Returns the time when the state was fixed
     *
     * @return DateTimeInterface|null
     *
     */
    public function getStateTime();

    /**
     * Set provider in error state
     *
     * @param bool $state
     *   Current status
     *
     * @param string $message
     *   Relative error message (if any)
     *
     * @return static
     *   The invoked object.
     */
    public function setState($state, $message = null);

    /**
     * Test the pool
     *
     * Test should be used to ensure the status flag is setted correctly.
     * If test is passed, the status should be == CACHE_SUCCESS, otherwise it
     * should correspond to CACHE_ERROR
     *
     * @return bool
     *
     */
    public function test();

    public function getNamespace();

    public function setNamespace($namespace);

    public function clearNamespace();

    /**
     * Disable provider
     *
     * @return EnhancedCacheItemPoolStats
     */
    public function getStats();

}
